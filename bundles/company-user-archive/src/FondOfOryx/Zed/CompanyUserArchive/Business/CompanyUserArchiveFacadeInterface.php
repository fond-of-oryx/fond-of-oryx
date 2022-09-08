<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;

interface CompanyUserArchiveFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    public function createCompanyUserArchive(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer
    ): CompanyUserArchiveTransfer;
}
