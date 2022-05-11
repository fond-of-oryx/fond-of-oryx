<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function findOrCreateProportionalGiftCardValue(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
    ): ProportionalGiftCardValueTransfer;
}
