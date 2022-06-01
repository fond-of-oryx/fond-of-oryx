<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishSalesOrderNoPaymentGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isOnlyGiftCardPayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function calculateProportionalGiftCardValues(JellyfishOrderTransfer $jellyfishOrderTransfer, int $idSalesOrder): JellyfishOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalCouponValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): void;
}
