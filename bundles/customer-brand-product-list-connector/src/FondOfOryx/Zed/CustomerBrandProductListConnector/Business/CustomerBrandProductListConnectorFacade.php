<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorBusinessFactory getFactory()
 */
class CustomerBrandProductListConnectorFacade extends AbstractFacade implements CustomerBrandProductListConnectorFacadeInterface
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
    public function persistCustomerBrandRelationByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void {
        $this->getFactory()
            ->createCustomerBrandRelationPersister()
            ->persistByCustomerProductListRelation($customerProductListRelationTransfer);
    }
}
