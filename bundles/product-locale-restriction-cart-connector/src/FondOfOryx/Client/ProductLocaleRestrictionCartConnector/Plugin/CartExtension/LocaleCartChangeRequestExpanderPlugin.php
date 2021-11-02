<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Plugin\CartExtension;

use Generated\Shared\Transfer\CartChangeTransfer;
use Spryker\Client\CartExtension\Dependency\Plugin\CartChangeRequestExpanderPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorFactory getFactory()
 */
class LocaleCartChangeRequestExpanderPlugin extends AbstractPlugin implements CartChangeRequestExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     * @param array $params
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expand(CartChangeTransfer $cartChangeTransfer, array $params = []): CartChangeTransfer
    {
        return $cartChangeTransfer->setCurrentLocale(
            $this->getFactory()->getLocaleClient()->getCurrentLocale(),
        );
    }
}
