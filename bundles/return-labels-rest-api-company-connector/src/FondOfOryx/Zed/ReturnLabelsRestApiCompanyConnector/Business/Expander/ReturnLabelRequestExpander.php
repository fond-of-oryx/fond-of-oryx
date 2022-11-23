<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReaderInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestExpander implements ReturnLabelRequestExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReaderInterface
     */
    protected $companyReader;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReaderInterface $companyReader
     */
    public function __construct(CompanyReaderInterface $companyReader)
    {
        $this->companyReader = $companyReader;
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

        $companyTransfer = $this->companyReader->getByRestReturnLabelRequest($restReturnLabelRequestTransfer);

        if ($companyTransfer === null) {
            return $returnLabelRequestTransfer;
        }

        $returnLabelRequestTransfer
            ->getCustomer()
            ->setReference($companyTransfer->getDebtorNumber());

        return $returnLabelRequestTransfer;
    }
}
