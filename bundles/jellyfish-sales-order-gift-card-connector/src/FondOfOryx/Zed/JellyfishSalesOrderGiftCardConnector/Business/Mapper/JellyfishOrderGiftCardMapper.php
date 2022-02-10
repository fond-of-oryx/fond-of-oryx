<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper;

use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class JellyfishOrderGiftCardMapper implements JellyfishOrderGiftCardMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer
     */
    public function fromSalesPayment(SpySalesPayment $salesPayment): JellyfishOrderGiftCardTransfer
    {
        return (new JellyfishOrderGiftCardTransfer())->setCode($this->getCode($salesPayment))
            ->setAmount($salesPayment->getAmount());
    }

    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return string
     */
    protected function getCode(SpySalesPayment $salesPayment): string
    {
        return $salesPayment->getSpyGiftCardPayments()->offsetGet(0)->getCode();
    }
}
