<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function createErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $orderAddressTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function createErpOrderAddress(ErpOrderAddressTransfer $orderAddressTransfer): ErpOrderAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $orderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function createErpOrderTotal(ErpOrderTotalTransfer $orderTotalTransfer): ErpOrderTotalTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $itemTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function createErpOrderItem(ErpOrderItemTransfer $itemTransfer): ErpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function updateErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $orderItemTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function updateErpOrderItem(ErpOrderItemTransfer $orderItemTransfer): ErpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function updateErpOrderAddress(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function updateErpOrderTotal(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function deleteErpOrderByIdErpOrder(int $idErpOrder): void;

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    public function deleteErpOrderItemByIdErpOrderItem(int $idErpOrderItem): void;

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    public function deleteErpOrderAddressByIdErpOrderAddress(int $idErpOrderAddress): void;
}
