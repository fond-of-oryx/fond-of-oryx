<?php

namespace FondOfOryx\Zed\CreditMemo\Business;

use Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CreditMemo\Business\CreditMemoBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface getRepository()
 */
class CreditMemoFacade extends AbstractFacade implements CreditMemoFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function createCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer
    {
        return $this->getFactory()->createCreditMemoWriter()->create($creditMemoTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function updateCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer
    {
        return $this->getFactory()->createCreditMemoWriter()->update($creditMemoTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function addSalesPaymentMethodTypeToCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFactory()->createCreditMemoPaymentResolver()->resolveAndAdd($creditMemoTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function addLocaleToCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFactory()->createCreditMemoLocaleResolver()->resolveAndAdd($creditMemoTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemoItems(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFactory()->createCreditMemoItemsWriter()->create($creditMemoTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function createCreditMemoReference(): string
    {
        return $this->getFactory()->createCreditMemoReferenceGenerator()->generate();
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface>
     */
    public function getRegisteredProcessor(): array
    {
        return $this->getFactory()->createCreditMemoProcessor()->getProcessor();
    }

    /**
     * @param array<string> $processorPlugins
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer
     */
    public function processCreditMemos(
        array $processorPlugins,
        array $ids
    ): CreditMemoProcessorResponseCollectionTransfer {
        return $this->getFactory()->createCreditMemoProcessor()->process($processorPlugins, $ids);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): SpySalesOrder
    {
        return $this->getRepository()->getSalesOrderByCreditMemo($creditMemoTransfer);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo>
     */
    public function getCreditMemoBySalesOrderId(int $idSalesOrder): array
    {
        return $this->getRepository()->findCreditMemoByFkSalesOrder($idSalesOrder);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function getCreditMemoBySalesOrderItem(SpySalesOrderItem $salesOrderItem): ?FooCreditMemo
    {
        return $this->getRepository()->findCreditMemoByFkSalesOrderItem($salesOrderItem);
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $spySalesOrderItems
     *
     * @return array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo>
     */
    public function getCreditMemosBySalesOrderItems(array $spySalesOrderItems): array
    {
        return $this->getFactory()->createCreditMemoReader()->getCreditMemoBySalesOrderItems($spySalesOrderItems);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection
    {
        return $this->getRepository()->getSalesOrderItemsByCreditMemo($creditMemoTransfer);
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findCreditMemoItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer
    {
        return $this->getRepository()->findCreditMemoItemByIdSalesOrderItem($idSalesOrderItem);
    }
}
