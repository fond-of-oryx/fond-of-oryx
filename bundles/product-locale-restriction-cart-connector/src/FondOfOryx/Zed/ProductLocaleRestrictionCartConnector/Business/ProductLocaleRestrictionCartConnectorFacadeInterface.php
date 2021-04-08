<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

interface ProductLocaleRestrictionCartConnectorFacadeInterface
{
    /**
     * Specification
     * - Checks cart change for restricted products.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function preCheckCart(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer;
}
