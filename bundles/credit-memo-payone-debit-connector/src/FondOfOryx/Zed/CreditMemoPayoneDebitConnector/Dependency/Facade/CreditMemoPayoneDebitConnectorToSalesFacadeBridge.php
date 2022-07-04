<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade;

use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class CreditMemoPayoneDebitConnectorToSalesFacadeBridge implements CreditMemoPayoneDebitConnectorToSalesFacadeInterface
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
     * @return array<string>
     */
    public function getDistinctOrderStates(int $idSalesOrder): array
    {
        return $this->salesFacade->getDistinctOrderStates($idSalesOrder);
    }
}
