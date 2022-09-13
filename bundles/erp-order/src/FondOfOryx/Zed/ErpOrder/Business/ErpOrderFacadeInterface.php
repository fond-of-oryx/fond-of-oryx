<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function createErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function updateErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function deleteErpOrderByIdErpOrder(int $idErpOrder): void;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByIdErpOrder(int $idErpOrder): ?ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistBillingAddress(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistShippingAddress(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderItem(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderTotals(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;
}
