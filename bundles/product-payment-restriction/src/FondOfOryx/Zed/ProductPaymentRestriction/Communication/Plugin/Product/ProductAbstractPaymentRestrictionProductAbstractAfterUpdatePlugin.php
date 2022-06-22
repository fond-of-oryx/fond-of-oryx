<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacadeInterface getFacade()
 */
class ProductAbstractPaymentRestrictionProductAbstractAfterUpdatePlugin extends AbstractPlugin implements ProductAbstractPluginUpdateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function update(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $this->getFacade()->persistProductAbstractPaymentRestrictions($productAbstractTransfer);

        return $productAbstractTransfer;
    }
}
