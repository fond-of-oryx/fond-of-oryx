<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

interface CartCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function preCheck(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer;
}
