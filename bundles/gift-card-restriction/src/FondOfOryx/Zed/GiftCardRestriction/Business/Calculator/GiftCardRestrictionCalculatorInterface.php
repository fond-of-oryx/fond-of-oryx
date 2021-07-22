<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Calculator;

use Generated\Shared\Transfer\CalculableObjectTransfer;

interface GiftCardRestrictionCalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer): void;
}
