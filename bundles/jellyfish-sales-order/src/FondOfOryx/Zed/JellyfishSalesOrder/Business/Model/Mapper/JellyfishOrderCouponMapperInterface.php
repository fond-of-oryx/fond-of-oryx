<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderCouponTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

interface JellyfishOrderCouponMapperInterface
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
    ): JellyfishOrderCouponTransfer;
}
