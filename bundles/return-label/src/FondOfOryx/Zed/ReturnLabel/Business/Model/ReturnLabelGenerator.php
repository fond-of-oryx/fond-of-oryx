<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelServiceRequestTransfer;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    protected $returnLabelAdapter;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface
     */
    protected $returnLabelAddressMapper;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface $returnLabelAdapter
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface $returnLabelAddressMapper
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelAdapterInterface $returnLabelAdapter,
        ReturnLabelAddressMapperInterface $returnLabelAddressMapper
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelAdapter = $returnLabelAdapter;
        $this->returnLabelAddressMapper = $returnLabelAddressMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelResponseTransfer
     */
    public function generate(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer {
        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getByReturnLabelRequest(
            $returnLabelRequestTransfer
        );

        if ($companyUnitAddressTransfer === null) {
            return new ReturnLabelResponseTransfer();
        }

        $returnLabelCustomerTransfer = (new ReturnLabelCustomerTransfer())
            ->setReceiverId('deu')
            ->setCustomerReference('50000')
            ->setEmail('foobar@mailinator.com')
            ->setPhone('657890657890')
            ->setAddress($this->returnLabelAddressMapper
                ->mapCompanyUnitAddressToReturnLabelAddress(
                    $companyUnitAddressTransfer,
                    new ReturnLabelAddressTransfer()
                )
            )
        ;

        $returnLabelServiceRequestTransfer = (new ReturnLabelServiceRequestTransfer())
            ->setQrCode(true)
            ->setReturnForm(true)
            ->setCustomer($returnLabelCustomerTransfer);

        $response = $this->returnLabelAdapter
            ->sendRequest($returnLabelServiceRequestTransfer);

        var_dump($response);
        die();

        // TODO: Map to ReturnLabelResponseTransfer and return
        return new ReturnLabelResponseTransfer();
    }
}
