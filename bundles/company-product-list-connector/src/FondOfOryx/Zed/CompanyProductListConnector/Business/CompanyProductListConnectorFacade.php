<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorBusinessFactory getFactory()
 */
class CompanyProductListConnectorFacade extends AbstractFacade implements CompanyProductListConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void {
        $this->getFactory()->createCompanyProductListRelationPersister()->persist(
            $companyProductListRelationTransfer,
        );
    }

    /**
     * Specifications:
     * - Retrieves assigned product list ids by company id
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getAssignedProductListIdsByIdCompany(int $idCompany): array
    {
        return $this->getFactory()->createProductListReader()->getIdsByIdCompany($idCompany);
    }
}
