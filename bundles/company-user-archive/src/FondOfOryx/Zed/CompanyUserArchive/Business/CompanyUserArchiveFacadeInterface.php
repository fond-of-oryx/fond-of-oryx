<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserArchiveFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function createCompanyUserArchive(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer;
}
