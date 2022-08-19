<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Persistence;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchive;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchivePersistenceFactory getFactory()
 */
class CompanyUserArchiveEntityManager extends AbstractEntityManager implements CompanyUserArchiveEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    public function createCompanyUserArchive(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer
    ): CompanyUserArchiveTransfer {
        $mapper = $this->getFactory()->createCompanyUserArchiveMapper();

        $fooCompanyUserArchive = $mapper
            ->mapTransferToEntity($companyUserArchiveTransfer, new FooCompanyUserArchive());

        $fooCompanyUserArchive->save();

        return $companyUserArchiveTransfer;
    }
}
