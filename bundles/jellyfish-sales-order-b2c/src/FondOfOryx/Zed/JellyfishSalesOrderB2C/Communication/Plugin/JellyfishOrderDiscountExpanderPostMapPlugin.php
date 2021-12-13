<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderB2C\Communication\Plugin;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderDiscountTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountCode;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderDiscountExpanderPostMapPlugin implements JellyfishOrderExpanderPostMapPluginInterface
{
    /**
     * Specification:
     *  - Expand JellyfishOrderTransfer object after mapping.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $jellyfishOrderDiscounts = [];
        foreach ($jellyfishOrderTransfer->getDiscounts() as $discountTransfer) {
            $jellyfishOrderDiscounts[$this->getIdSalesOrder($discountTransfer)] = $discountTransfer;
        }

        if (method_exists($salesOrder, 'getDiscounts')) {
            foreach ($salesOrder->getDiscounts() as $salesDiscount) {
                foreach ($jellyfishOrderDiscounts as $jellyDiscount) {
                    $jellyfishOrderDiscount = $this->validateAndExtendDiscount($salesDiscount, $jellyDiscount);

                    $jellyfishOrderDiscounts[$jellyfishOrderDiscount->getIdSalesOrderItem()] = $jellyfishOrderDiscount;
                }
            }
        }

        return $jellyfishOrderTransfer->setDiscounts(new ArrayObject($jellyfishOrderDiscounts));
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     * @param \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer $jellyfishDiscount
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer
     */
    protected function validateAndExtendDiscount(
        SpySalesDiscount $salesDiscount,
        JellyfishOrderDiscountTransfer $jellyfishDiscount
    ): JellyfishOrderDiscountTransfer {
        if (empty($jellyfishDiscount->getName()) === false && $jellyfishDiscount->getIdSalesOrderItem() !== null) {
            return $jellyfishDiscount;
        }

        foreach ($salesDiscount->getDiscountCodes() as $salesDiscountCode) {
            if ($this->compare($salesDiscountCode, $jellyfishDiscount, $salesDiscount) === true) {
                $jellyfishDiscount->setName($this->getDiscountName($jellyfishDiscount, $salesDiscount));
                $jellyfishDiscount->setIdSalesOrderItem($this->getIdSalesOrder($jellyfishDiscount));
            }
        }

        return $jellyfishDiscount;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer $jellyfishDiscount
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     *
     * @return string
     */
    protected function getDiscountName(
        JellyfishOrderDiscountTransfer $jellyfishDiscount,
        SpySalesDiscount $salesDiscount
    ): string {
        if ($jellyfishDiscount->getName() !== null && $jellyfishDiscount->getName() !== '') {
            return $jellyfishDiscount->getName();
        }

        return $salesDiscount->getDisplayName();
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer $jellyfishDiscount
     *
     * @return int
     */
    protected function getIdSalesOrder(
        JellyfishOrderDiscountTransfer $jellyfishDiscount
    ): int {
        return $jellyfishDiscount->getIdSalesOrderItem() ?? 0;
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

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscountCode $salesDiscountCode
     * @param \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer $jellyfishDiscount
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     *
     * @return bool
     */
    protected function compare(
        SpySalesDiscountCode $salesDiscountCode,
        JellyfishOrderDiscountTransfer $jellyfishDiscount,
        SpySalesDiscount $salesDiscount
    ): bool {
        return $salesDiscountCode->getCode() === $jellyfishDiscount->getCode()
            && $jellyfishDiscount->getSumAmount() === $salesDiscount->getAmount()
            && $jellyfishDiscount->getQuantity() === $this->getQuantity($salesDiscount);
    }
}
