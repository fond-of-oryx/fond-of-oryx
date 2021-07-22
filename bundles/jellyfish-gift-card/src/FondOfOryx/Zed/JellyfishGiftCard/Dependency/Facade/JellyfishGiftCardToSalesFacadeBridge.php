<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishGiftCardToSalesFacadeBridge implements JellyfishGiftCardToSalesFacadeInterface
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
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\OrderTransfer|null
     */
    public function findOrderByIdSalesOrderItem(int $idSalesOrderItem): ?OrderTransfer
    {
        return $this->salesFacade->findOrderByIdSalesOrderItem($idSalesOrderItem);
    }
}
