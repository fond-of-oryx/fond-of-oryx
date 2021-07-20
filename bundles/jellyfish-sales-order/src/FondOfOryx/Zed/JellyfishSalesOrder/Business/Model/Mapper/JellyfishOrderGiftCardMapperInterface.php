<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

interface JellyfishOrderGiftCardMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer
     */
    public function fromSalesPayment(SpySalesPayment $salesPayment): JellyfishOrderGiftCardTransfer;
}
