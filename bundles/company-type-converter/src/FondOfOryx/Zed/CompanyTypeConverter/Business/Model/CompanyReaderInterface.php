<?php

namespace FondOfOryx\Zed\CompanyTypeConverter\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;
}
