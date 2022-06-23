<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductExtension\Dependency\Plugin\ProductAbstractPostCreatePluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacadeInterface getFacade()
 */
class ProductAbstractPaymentRestrictionProductAbstractAfterPostCreatePlugin extends AbstractPlugin implements ProductAbstractPostCreatePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function postCreate(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->persistProductAbstractPaymentRestrictions($productAbstractTransfer);
    }
}
