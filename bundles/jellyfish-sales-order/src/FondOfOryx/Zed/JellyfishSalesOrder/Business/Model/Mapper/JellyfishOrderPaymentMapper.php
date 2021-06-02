<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderPaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class JellyfishOrderPaymentMapper implements JellyfishOrderPaymentMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $salesPayment
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderPaymentTransfer
     */
    public function fromSalesPayment(SpySalesPayment $salesPayment): JellyfishOrderPaymentTransfer
    {
        $jellyfishOrderPayment = new JellyfishOrderPaymentTransfer();

        $jellyfishOrderPayment->setAmount($salesPayment->getAmount())
            ->setMethod($salesPayment->getSalesPaymentMethodType()->getPaymentMethod())
            ->setProvider($salesPayment->getSalesPaymentMethodType()->getPaymentProvider());

        return $jellyfishOrderPayment;
    }
}
