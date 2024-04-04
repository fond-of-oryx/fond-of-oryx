<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business;

use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderBusinessFactory getFactory()
 */
class ProductPageSearchAttributeExpanderFacade extends AbstractFacade implements ProductPageSearchAttributeExpanderFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productPage
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return array
     */
    public function expandProductPageData(array $productPage, ProductPageSearchTransfer $productAbstractPageSearchTransfer): array
    {
        return $this->getFactory()
            ->createProductPageDataExpander()
            ->expand($productPage, $productAbstractPageSearchTransfer);
    }
}
