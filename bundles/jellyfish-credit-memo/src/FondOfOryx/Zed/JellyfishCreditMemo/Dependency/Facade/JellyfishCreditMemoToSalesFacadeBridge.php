<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishCreditMemoToSalesFacadeBridge implements JellyfishCreditMemoToSalesFacadeInterface
{
    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct(SalesFacadeInterface $salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer|null
     */
    public function findOrderByIdSalesOrder(int $idSalesOrder): ?OrderTransfer
    {
        return $this->salesFacade->findOrderByIdSalesOrder($idSalesOrder);
    }
}
