<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Persistence;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;

interface CompanyUserArchiveEntityManagerInterface
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
