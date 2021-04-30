<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorBusinessFactory getFactory()
 */
class ProductLocaleRestrictionCartConnectorFacade extends AbstractFacade implements ProductLocaleRestrictionCartConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function preCheckCart(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        return $this->getFactory()->createCartChecker()->preCheck($cartChangeTransfer);
    }
}
