<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginReadInterface;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacadeInterface getFacade()
 */
class ProductAbstractPaymentRestrictionProductAbstractReadPlugin extends AbstractPlugin implements ProductAbstractPluginReadInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function read(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->expandProductAbstract($productAbstractTransfer);
    }
}
