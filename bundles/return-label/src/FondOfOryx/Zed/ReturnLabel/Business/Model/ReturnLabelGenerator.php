<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
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
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    protected $returnLabelAdapter;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface
     */
    protected $returnLabelAddressMapper;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface $returnLabelAdapter
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface $returnLabelAddressMapper
     * @param \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig $config
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        CompanyBusinessUnitReaderInterface $companyBusinessUnitReader,
        ReturnLabelAdapterInterface $returnLabelAdapter,
        ReturnLabelAddressMapperInterface $returnLabelAddressMapper,
        ReturnLabelConfig $config
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
        $this->returnLabelAdapter = $returnLabelAdapter;
        $this->returnLabelAddressMapper = $returnLabelAddressMapper;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelResponseTransfer
     */
    public function generate(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer {
        $returnLabelResponseTransfer = new ReturnLabelResponseTransfer();

        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getByReturnLabelRequest(
            $returnLabelRequestTransfer
        );

        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByReturnLabelRequest(
            $returnLabelRequestTransfer
        );

        if ($companyUnitAddressTransfer === null || $companyBusinessUnitTransfer === null) {
            $returnLabelResponseTransfer
        }

        $returnLabelCustomerTransfer = (new ReturnLabelCustomerTransfer())
            ->setReceiverId('deu')
            ->setCustomerReference($companyBusinessUnitTransfer->getCompany()->getDebtorNumber())
            ->setEmail($companyBusinessUnitTransfer->getEmail())
            ->setPhone($companyBusinessUnitTransfer->getPhone())
            ->setAddress($this->returnLabelAddressMapper
                ->mapCompanyUnitAddressToReturnLabelAddress(
                    $companyUnitAddressTransfe,
                    new ReturnLabelAddressTransfer()
                ));

        $returnLabelServiceRequestTransfer = (new ReturnLabelServiceRequestTransfer())
            ->setQrCode($this->config->printQrCodeOnReturnForm())
            ->setReturnForm($this->config->appendReturnForm())
            ->setCustomer($returnLabelCustomerTransfer);

        $response = $this->returnLabelAdapter
            ->sendRequest($returnLabelServiceRequestTransfer);

        // TODO: Map to ReturnLabelResponseTransfer and return
        return $returnLabelResponseTransfer->setData($response->getContents());
    }
}
