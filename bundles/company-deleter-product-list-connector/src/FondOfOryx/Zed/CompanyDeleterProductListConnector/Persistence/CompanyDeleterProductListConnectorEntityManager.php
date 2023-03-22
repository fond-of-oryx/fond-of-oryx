<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterProductListConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterProductListConnectorEntityManagerInterface
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
