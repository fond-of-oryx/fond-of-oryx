<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;


use Generated\Shared\Transfer\JellyfishOrderCouponTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class JellyfishOrderCouponMapper implements JellyfishOrderCouponMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     * @param string $couponType
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderCouponTransfer
     */
    public function fromSalesPayment(
        SpySalesPayment $salesPayment,
        string $couponType
    ): JellyfishOrderCouponTransfer {
        $jellyfishCoupon = new JellyfishOrderCouponTransfer();


        return  $jellyfishCoupon->setIdSalesOrder($salesPayment->getFkSalesOrder())
            ->setCode($this->getCode($salesPayment))
            ->setAmount($salesPayment->getAmount())
            ->setType($couponType);
    }

    /**
     * @TODO use all of the codes nut just from index 0 if it is neccessary in the Future
     *
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return string
     */
    protected function getCode(SpySalesPayment $salesPayment): string
    {
        return $salesPayment->getSpyGiftCardPayments()->offsetGet(0)->getCode();
    }
}
