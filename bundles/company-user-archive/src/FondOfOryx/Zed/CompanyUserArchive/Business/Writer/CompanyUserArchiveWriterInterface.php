<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business\Writer;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserArchiveWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function createCompanyUserArchive(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer;
}
