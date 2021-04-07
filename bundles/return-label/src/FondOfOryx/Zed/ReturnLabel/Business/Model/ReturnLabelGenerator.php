<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use Generated\Shared\Transfer\AddressesTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;
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
     * @var ReturnLabelAddressMapperInterface
     */
    protected $returnLabelAddressMapper;

    /**
     * @param CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param ReturnLabelAdapterInterface $returnLabelAdapter
     * @param ReturnLabelAddressMapperInterface $returnLabelAddressMapper
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

        $returnLabelAddressTransfer = $this->returnLabelAddressMapper
            ->mapCompanyUnitAddressToReturnLabelAddress(
                $companyUnitAddressTransfer,
                new ReturnLabelAddressTransfer()
            )
        ;

        $returnLabelServiceRequestTransfer = (new ReturnLabelServiceRequestTransfer())
            ->setQrCode(true)
            ->setReturnForm(true)
            ->setReturnLabelAddress($returnLabelAddressTransfer);

        $response = $this->returnLabelAdapter
            ->sendRequest($returnLabelServiceRequest); //TODO: Use api transfer model

        var_dump($response);

        return new ReturnLabelResponseTransfer();

        // TODO: Map to ReturnLabelResponseTransfer and return
    }
}
