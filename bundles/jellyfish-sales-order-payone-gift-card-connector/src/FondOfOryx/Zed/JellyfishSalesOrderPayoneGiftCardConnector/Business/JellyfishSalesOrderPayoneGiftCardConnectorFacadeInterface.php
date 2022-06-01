<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function calculateProportionalGiftCardValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        int $idSalesOrder
    ): JellyfishOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalCouponValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): void;

    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function expandOrderItems(array $itemTransfers): array;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isPayonePayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool;
}
