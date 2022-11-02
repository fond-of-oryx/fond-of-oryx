<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiBusinessFactory getFactory()
 */
class CompanyProductListsRestApiFacade extends AbstractFacade implements CompanyProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    public function persistCompanyProductListRelation(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): void {
        $this->getFactory()->createCompanyProductListRelationPersister()
            ->persist(
                $restProductListUpdateRequestTransfer,
                $productListTransfer,
            );
    }
}
