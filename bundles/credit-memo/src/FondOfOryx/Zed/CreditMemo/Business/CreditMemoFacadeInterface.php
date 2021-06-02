<?php

namespace FondOfOryx\Zed\CreditMemo\Business;

use Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;

interface CreditMemoFacadeInterface
{
    /**
     * Specification:
     * - Creates credit memo
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function createCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function updateCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function addSalesPaymentMethodTypeToCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function addLocaleToCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;

    /**
     * Specification:
     * - Creates credit memo items
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemoItems(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;

    /**
     * Specification:
     * - Creates credit memo reference
     *
     * @api
     *
     * @return string
     */
    public function createCreditMemoReference(): string;

    /**
     * @param string[] $processorPlugins
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer
     */
    public function processCreditMemos(array $processorPlugins, array $ids): CreditMemoProcessorResponseCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): SpySalesOrder;

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function getCreditMemoBySalesOrderId(int $idSalesOrder): array;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function getCreditMemoBySalesOrderItem(SpySalesOrderItem $salesOrderItem): ?FooCreditMemo;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $spySalesOrderItems
     *
     * @throws \Exception
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function getCreditMemosBySalesOrderItems(array $spySalesOrderItems): array;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection;

    /**
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface[]
     */
    public function getRegisteredProcessor(): array;
}
