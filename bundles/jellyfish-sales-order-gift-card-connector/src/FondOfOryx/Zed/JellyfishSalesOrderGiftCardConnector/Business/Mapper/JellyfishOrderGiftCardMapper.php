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
        $jellyfishGiftCard = new JellyfishOrderGiftCardTransfer();

        return $jellyfishGiftCard
            ->setCode($this->getCode($salesPayment))
            ->setAmount($salesPayment->getAmount());
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
