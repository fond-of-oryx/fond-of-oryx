<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyBusinessUnitExpander implements CompanyBusinessUnitExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     */
    public function __construct(CompanyBusinessUnitReaderInterface $companyBusinessUnitReader)
    {
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
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
        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByRestReturnLabelRequest($restReturnLabelRequestTransfer);

        if ($companyBusinessUnitTransfer === null || !$companyBusinessUnitTransfer->getEmail()) {
            return $returnLabelRequestTransfer;
        }

        $returnLabelRequestTransfer->getCustomer()->setEmail($companyBusinessUnitTransfer->getEmail());

        return $returnLabelRequestTransfer;
    }
}
