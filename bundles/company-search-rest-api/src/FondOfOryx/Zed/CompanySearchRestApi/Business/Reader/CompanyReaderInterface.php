<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyListTransfer;

interface CompanyReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function findByCompanyList(CompanyListTransfer $companyListTransfer): CompanyListTransfer;
}
