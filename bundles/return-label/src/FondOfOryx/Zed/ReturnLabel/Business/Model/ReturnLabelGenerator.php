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
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface;

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
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface
     */
    protected $returnLabelCustomerMapper;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface $returnLabelAdapter
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface $returnLabelCustomerMapper
     * @param \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig $config
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        CompanyBusinessUnitReaderInterface $companyBusinessUnitReader,
        ReturnLabelAdapterInterface $returnLabelAdapter,
        ReturnLabelCustomerMapperInterface $returnLabelCustomerMapper,
        ReturnLabelConfig $config
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
        $this->returnLabelAdapter = $returnLabelAdapter;
        $this->returnLabelCustomerMapper = $returnLabelCustomerMapper;
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
            return $returnLabelResponseTransfer;
        }

        $returnLabelCustomerTransfer = $this->returnLabelCustomerMapper->mapCompanyUnitAddressToReturnLabelCustomer(
            $returnLabelCustomerTransfer,
            new ReturnLabelCustomerTransfer()
        );

        $returnLabelServiceRequestTransfer = (new ReturnLabelServiceRequestTransfer())
            ->setQrCode($this->config->printQrCodeOnReturnForm())
            ->setReturnForm($this->config->appendReturnForm())
            ->setCustomer($returnLabelCustomerTransfer);

        $response = $this->returnLabelAdapter
            ->sendRequest($returnLabelServiceRequestTransfer);

        return $returnLabelResponseTransfer->setData($response->getContents());
    }
}
