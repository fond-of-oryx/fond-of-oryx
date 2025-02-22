<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
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
     * @param string $reference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByReference(string $reference): ?ErpOrderTransfer;

    /**
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByExternalReference(string $externalReference): ?ErpOrderTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderExpense(ErpOrderTransfer $erpOrderTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function persistErpOrderItemAmounts(
        ErpOrderItemTransfer $erpOrderItemTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function persistErpOrderExpenseAmounts(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer;
}
