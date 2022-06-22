<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper;

use Generated\Shared\Transfer\PaymentMethodTransfer;
use Orm\Zed\Payment\Persistence\SpyPaymentMethod;

class PaymentMethodMapper implements PaymentMethodMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpyPaymentMethod $spyPaymentMethod
     *
     * @return \Generated\Shared\Transfer\PaymentMethodTransfer
     */
    public function mapEntityToTransfer(SpyPaymentMethod $spyPaymentMethod): PaymentMethodTransfer
    {
        return (new PaymentMethodTransfer())
            ->fromArray($spyPaymentMethod->toArray(), true)
            ->setIdPaymentProvider($spyPaymentMethod->getIdPaymentMethod())
            ->setMethodName($spyPaymentMethod->getPaymentMethodKey());
    }
}
