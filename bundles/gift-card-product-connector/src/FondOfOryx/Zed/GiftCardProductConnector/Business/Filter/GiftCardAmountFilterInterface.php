<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\Filter;

use ArrayObject;

interface GiftCardAmountFilterInterface
{
    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\PriceProductTransfer[] $priceProductTransfers
     *
     * @return int
     */
    public function filterFromPriceProducts(ArrayObject $priceProductTransfers): int;
}
