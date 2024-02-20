<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;

interface RestCompanySearchResultItemExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer $restCompanySearchResultItemTransfer
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer
     */
    public function expand(
        RestCompanySearchResultItemTransfer $restCompanySearchResultItemTransfer,
        CompanyTransfer $companyTransfer
    ): RestCompanySearchResultItemTransfer;
}
