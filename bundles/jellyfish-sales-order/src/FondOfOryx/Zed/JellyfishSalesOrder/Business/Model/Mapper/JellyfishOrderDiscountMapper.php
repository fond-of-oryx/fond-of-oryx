<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderDiscountTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

class JellyfishOrderDiscountMapper implements JellyfishOrderDiscountMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer
     */
    public function fromSalesDiscount(SpySalesDiscount $salesDiscount): JellyfishOrderDiscountTransfer
    {
        $jellyfishOrderDiscount = new JellyfishOrderDiscountTransfer();

        $quantity = $this->getQuantity($salesDiscount);

        $jellyfishOrderDiscount->setName($salesDiscount->getName())
            ->setIdSalesOrderItem($salesDiscount->getFkSalesOrderItem())
            ->setDescription($salesDiscount->getDescription())
            ->setQuantity($quantity)
            ->setUnitAmount((int)round($salesDiscount->getAmount() / $quantity))
            ->setSumAmount($salesDiscount->getAmount());

        foreach ($salesDiscount->getDiscountCodes() as $salesDiscountCode) {
            $jellyfishOrderDiscount->setCode($salesDiscountCode->getCode());
        }

        return $jellyfishOrderDiscount;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     *
     * @return int
     */
    protected function getQuantity(SpySalesDiscount $salesDiscount): int
    {
        $salesOrderItem = $salesDiscount->getOrderItem();

        return $salesOrderItem === null ? 1 : $salesOrderItem->getQuantity();
    }
}
