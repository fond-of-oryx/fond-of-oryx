<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginCreateInterface;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig getConfig()
 */
class GiftCardProductConnectorProductAbstractAfterCreatePlugin extends AbstractPlugin implements ProductAbstractPluginCreateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function create(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->saveGiftCardProductAbstractConfiguration($productAbstractTransfer);
    }
}
