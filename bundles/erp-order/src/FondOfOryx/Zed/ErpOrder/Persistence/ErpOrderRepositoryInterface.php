<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderRepositoryInterface
{
    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByIdErpOrder(int $idErpOrder): ?ErpOrderTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemCollectionTransfer
     */
    public function findErpOrderItemsByIdErpOrder(int $idErpOrder): ErpOrderItemCollectionTransfer;

    /**
     * @param int $idErpOrderItem
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer|null
     */
    public function findErpOrderItemByIdErpOrderItem(int $idErpOrderItem): ?ErpOrderItemTransfer;

    /**
     * @param int $idErpOrderAddress
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer|null
     */
    public function findErpOrderAddressByIdErpOrderAddress(int $idErpOrderAddress): ?ErpOrderAddressTransfer;

    /**
     * @param int $idErpOrderTotal
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrderTotal(int $idErpOrderTotal): ?ErpOrderTotalTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrder(int $idErpOrder): ?ErpOrderTotalTransfer;

    /**
     * @param int $idErpOrderTotals
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null
     */
    public function findErpOrderTotalsByIdErpOrderTotals(int $idErpOrderTotals): ?ErpOrderTotalsTransfer;
}
