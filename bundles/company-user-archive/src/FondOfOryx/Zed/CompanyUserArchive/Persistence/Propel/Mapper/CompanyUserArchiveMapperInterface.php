<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchive;

interface CompanyUserArchiveMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     * @param \Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchive $fooCompanyUserArchive
     *
     * @return \Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchive
     */
    public function mapTransferToEntity(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer,
        FooCompanyUserArchive $fooCompanyUserArchive
    ): FooCompanyUserArchive;
}
