<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginReadInterface;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface getFacade()
 */
class ProductAbstractCountryRestrictionProductAbstractReadPlugin extends AbstractPlugin implements ProductAbstractPluginReadInterface
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
