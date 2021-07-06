<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginCreateInterface;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig getConfig()
 */
class GiftCardProductConnectorProductConcreteAfterCreatePlugin extends AbstractPlugin implements ProductConcretePluginCreateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function create(ProductConcreteTransfer $productConcreteTransfer): ProductConcreteTransfer
    {
        return $this->getFacade()->saveGiftCardProductConfiguration($productConcreteTransfer);
    }
}
