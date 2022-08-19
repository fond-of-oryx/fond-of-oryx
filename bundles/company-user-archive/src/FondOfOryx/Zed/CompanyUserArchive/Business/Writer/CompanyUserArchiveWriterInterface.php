<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business\Writer;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;

interface CompanyUserArchiveWriterInterface
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
