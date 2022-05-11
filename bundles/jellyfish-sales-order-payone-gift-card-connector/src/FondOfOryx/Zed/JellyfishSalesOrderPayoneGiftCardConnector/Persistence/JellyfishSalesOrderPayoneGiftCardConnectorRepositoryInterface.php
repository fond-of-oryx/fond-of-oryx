<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null
     */
    public function findProportionalGiftCardValue(ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer): ?ProportionalGiftCardValueTransfer;
}
