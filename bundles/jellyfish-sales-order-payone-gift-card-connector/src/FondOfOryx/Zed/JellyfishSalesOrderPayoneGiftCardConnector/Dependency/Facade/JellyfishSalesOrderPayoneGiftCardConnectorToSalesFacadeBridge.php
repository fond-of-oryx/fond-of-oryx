<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeBridge implements JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
{
    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct(SalesFacadeInterface $salesFacade)
    {
        $this->facade = $salesFacade;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder(int $idSalesOrder): OrderTransfer
    {
        return $this->facade->getOrderByIdSalesOrder($idSalesOrder);
    }
}
