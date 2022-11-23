<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiBusinessFactory getFactory()
 */
class CustomerProductListsRestApiFacade extends AbstractFacade implements CustomerProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    public function persistCustomerProductListRelation(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): void {
        $this->getFactory()->createCustomerProductListRelationPersister()
            ->persist(
                $restProductListUpdateRequestTransfer,
                $productListTransfer,
            );
    }
}
