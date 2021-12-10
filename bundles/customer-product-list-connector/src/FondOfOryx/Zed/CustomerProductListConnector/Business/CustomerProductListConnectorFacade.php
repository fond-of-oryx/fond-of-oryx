<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorBusinessFactory getFactory()
 */
class CustomerProductListConnectorFacade extends AbstractFacade implements CustomerProductListConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void {
        $this->getFactory()->createCustomerProductListRelationPersister()->persist(
            $customerProductListRelationTransfer,
        );
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getAssignedProductListIdsByIdCustomer(int $idCustomer): array
    {
        return $this->getFactory()->createProductListReader()->getIdsByIdCustomer($idCustomer);
    }
}
