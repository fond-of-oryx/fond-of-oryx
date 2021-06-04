<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\ObjectCollection;

class PayoneCreditMemoToCreditMemoBridge implements PayoneCreditMemoToCreditMemoInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface
     */
    protected $creditMemoFacade;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface $creditMemoFacade
     */
    public function __construct(CreditMemoFacadeInterface $creditMemoFacade)
    {
        $this->creditMemoFacade = $creditMemoFacade;
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
        return $this->creditMemoFacade->updateCreditMemo($creditMemoTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): SpySalesOrder
    {
        return $this->creditMemoFacade->getSalesOrderByCreditMemo($creditMemoTransfer);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function getCreditMemoBySalesOrderId(int $idSalesOrder): array
    {
        return $this->creditMemoFacade->getCreditMemoBySalesOrderId($idSalesOrder);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]]
     */
    public function getCreditMemosBySalesOrderItems(array $salesOrderItems): array
    {
        return $this->creditMemoFacade->getCreditMemosBySalesOrderItems($salesOrderItems);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection
    {
        return $this->creditMemoFacade->getSalesOrderItemsByCreditMemo($creditMemoTransfer);
    }
}
