<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\PreReloadItemsPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorFacadeInterface getFacade()
 */
class ProductLocaleRestrictionPreReloadItemsPlugin extends AbstractPlugin implements PreReloadItemsPluginInterface
{
    /**
     * Specification:
     *   - This plugin is execute before reloading cart items, with this plugin you can modify quote before reloading it.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function preReloadItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $quoteTransfer;
    }
}
