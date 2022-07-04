<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade;

use FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;

class CreditMemoPayoneDebitConnectorToCreditMemoBridge implements CreditMemoPayoneDebitConnectorToCreditMemoInterface
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
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findCreditMemoItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer
    {
        return $this->creditMemoFacade->findCreditMemoItemByIdSalesOrderItem($idSalesOrderItem);
    }
}
