<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

interface ProductListRestrictionValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function validate(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer;
}
