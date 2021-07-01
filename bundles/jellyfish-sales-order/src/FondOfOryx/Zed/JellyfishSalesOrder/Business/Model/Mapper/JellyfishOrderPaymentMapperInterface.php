<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderPaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

interface JellyfishOrderPaymentMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderPaymentTransfer
     */
    public function fromSalesPayment(SpySalesPayment $salesPayment): JellyfishOrderPaymentTransfer;
}
