<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use Generated\Shared\Transfer\CompanyTransfer;

interface LocaleReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return string|null
     */
    public function getNameByCompany(CompanyTransfer $companyTransfer): ?string;
}
