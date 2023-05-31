<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderDiscount\Communication\Plugin\JellyfishSalesOrderExtension;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderDiscountTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class DiscountJellyfishOrderExpanderPostMapPlugin extends AbstractPlugin implements JellyfishOrderExpanderPostMapPluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
      * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
      *
      * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
      */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $jellyfishOrderDiscounts = new ArrayObject();

        foreach ($salesOrder->getDiscounts() as $salesDiscount) {
            $salesOrderItem = $salesDiscount->getOrderItem();
            $quantity = $salesOrderItem === null ? 1 : $salesOrderItem->getQuantity();

            $jellyfishOrderDiscountTransfer = (new JellyfishOrderDiscountTransfer())->setName($salesDiscount->getName())
                ->setIdSalesOrderItem($salesDiscount->getFkSalesOrderItem())
                ->setDescription($salesDiscount->getDescription())
                ->setQuantity($quantity)
                ->setUnitAmount((int)round($salesDiscount->getAmount() / $quantity))
                ->setSumAmount($salesDiscount->getAmount());

            foreach ($salesDiscount->getDiscountCodes() as $salesDiscountCode) {
                $jellyfishOrderDiscountTransfer->setCode($salesDiscountCode->getCode());
            }

            $jellyfishOrderDiscounts->append($jellyfishOrderDiscountTransfer);
        }

        return $jellyfishOrderTransfer->setDiscounts($jellyfishOrderDiscounts);
    }
}
