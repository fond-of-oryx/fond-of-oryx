<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
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
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface $returnLabelRequestAddressMapper
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelRequestAddressMapperInterface $returnLabelRequestAddressMapper
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelRequestAddressMapper = $returnLabelRequestAddressMapper;
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

        $returnLabelRequestAddressTransfer = $this->returnLabelRequestAddressMapper->fromCompanyUnitAddressTransfer(
            $companyUnitAddressTransfer
        );

        $returnLabelRequestTransfer->getCustomer()
            ->setAddress($returnLabelRequestAddressTransfer);

        return $returnLabelRequestTransfer;
    }
}
