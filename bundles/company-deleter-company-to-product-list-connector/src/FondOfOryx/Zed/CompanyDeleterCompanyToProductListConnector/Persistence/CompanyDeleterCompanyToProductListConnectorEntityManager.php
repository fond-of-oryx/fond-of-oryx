<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterCompanyToProductListConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyToProductListConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyProductListRelationsByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $relations = $this->getFactory()->createSpyProductListCompanyQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($relations as $relation) {
            $relation->delete();
        }
    }
}
