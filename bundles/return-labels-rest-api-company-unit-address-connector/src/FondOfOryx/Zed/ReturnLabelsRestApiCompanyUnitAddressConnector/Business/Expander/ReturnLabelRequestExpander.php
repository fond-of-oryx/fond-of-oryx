<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestExpander implements ReturnLabelRequestExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface
     */
    protected $returnLabelRequestAddressMapper;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface $returnLabelRequestAddressMapper
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig $config
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelRequestAddressMapperInterface $returnLabelRequestAddressMapper,
        ReturnLabelsRestApiCompanyUnitAddressConnectorConfig $config
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelRequestAddressMapper = $returnLabelRequestAddressMapper;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        if ($returnLabelRequestTransfer->getCustomer() === null) {
            return $returnLabelRequestTransfer;
        }

        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getByRestReturnLabelRequest(
            $restReturnLabelRequestTransfer
        );

        if ($companyUnitAddressTransfer === null) {
            return $returnLabelRequestTransfer;
        }

        if (!array_key_exists($companyUnitAddressTransfer->getIso3code(), $this->config->getReceiver())) {
            return $returnLabelRequestTransfer;
        }

        $returnLabelRequestAddressTransfer = $this->returnLabelRequestAddressMapper->fromCompanyUnitAddressTransfer(
            $companyUnitAddressTransfer
        );

        $returnLabelRequestTransfer
            ->setReceiverId($this->config->getReceiver()[$companyUnitAddressTransfer->getIso3code()])
            ->getCustomer()->setAddress($returnLabelRequestAddressTransfer);

        return $returnLabelRequestTransfer;
    }
}
