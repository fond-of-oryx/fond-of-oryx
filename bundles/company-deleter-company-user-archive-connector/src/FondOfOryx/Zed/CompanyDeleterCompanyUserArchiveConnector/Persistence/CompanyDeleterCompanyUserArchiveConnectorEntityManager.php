<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterCompanyUserArchiveConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserArchiveByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $companyUserArchives = $this->getFactory()->createFooCompanyUserArchiveQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($companyUserArchives as $companyUserArchive) {
            $companyUserArchive->delete();
        }
    }
}
