<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderDiscountTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

interface JellyfishOrderDiscountMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $salesDiscount
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderDiscountTransfer
     */
    public function fromSalesDiscount(SpySalesDiscount $salesDiscount): JellyfishOrderDiscountTransfer;
}
