<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotals;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderAmount;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderExpense;

interface EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer|null $orderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function fromEprOrderItemToTransfer(
        ErpOrderItem $orderItem,
        ?ErpOrderItemTransfer $orderItemTransfer = null
    ): ErpOrderItemTransfer;

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrder $erpOrder
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function fromErpOrderToTransfer(
        ErpOrder $erpOrder,
        ?ErpOrderTransfer $erpOrderTransfer = null
    ): ErpOrderTransfer;

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderAddress $erpOrderAddress
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer|null $erpOrderAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function fromErpOrderAddressToTransfer(
        ErpOrderAddress $erpOrderAddress,
        ?ErpOrderAddressTransfer $erpOrderAddressTransfer = null
    ): ErpOrderAddressTransfer;

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderTotals $erpOrderTotals
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function fromErpOrderTotalsToTransfer(
        ErpOrderTotals $erpOrderTotals,
        ?ErpOrderTotalsTransfer $erpOrderTotalsTransfer = null
    ): ErpOrderTotalsTransfer;

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\FooErpOrderAmount $erpOrderTotal
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer|null $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function fromErpOrderAmountToTransfer(
        FooErpOrderAmount $erpOrderTotal,
        ?ErpOrderAmountTransfer $erpOrderAmountTransfer = null
    ): ErpOrderAmountTransfer;

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\FooErpOrderExpense $orderExpense
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer|null $orderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function fromEprOrderExpenseToTransfer(
        FooErpOrderExpense $orderExpense,
        ?ErpOrderExpenseTransfer $orderExpenseTransfer = null
    ): ErpOrderExpenseTransfer;
}
