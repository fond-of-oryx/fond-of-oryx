<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use Generated\Shared\Transfer\CompanyTransfer;

interface CurrencyReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return string|null
     */
    public function getCodeByCompany(CompanyTransfer $companyTransfer): ?string;
}
