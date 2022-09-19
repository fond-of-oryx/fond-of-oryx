<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotals;

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
}
