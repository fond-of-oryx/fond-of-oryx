<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\Filter;

use ArrayObject;
use Exception;

class GiftCardAmountFilter implements GiftCardAmountFilterInterface
{
    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\PriceProductTransfer[] $priceProductTransfers
     *
     * @throws \Exception
     *
     * @return int
     */
    public function filterFromPriceProducts(ArrayObject $priceProductTransfers): int
    {
        $giftCardAmount = null;

        foreach ($priceProductTransfers as $priceProductTransfer) {
            $moneyValueTransfer = $priceProductTransfer->getMoneyValue();

            if ($moneyValueTransfer === null || $moneyValueTransfer->getGrossAmount() === null) {
                continue;
            }

            if ($giftCardAmount === null) {
                $giftCardAmount = $moneyValueTransfer->getGrossAmount();

                continue;
            }

            if ($giftCardAmount !== $moneyValueTransfer->getGrossAmount()) {
                throw new Exception('Different prices for different store are not allowed.');
            }
        }

        if ($giftCardAmount === null) {
            throw new Exception('Could not filter gift card amount.');
        }

        return $giftCardAmount;
    }
}
