<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentProviderTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;

class CreditMemoSalesPaymentMethodTypeMapper implements CreditMemoSalesPaymentMethodTypeMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType $paymentMethodType
     * @param \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer $salesPaymentMethodTypeTransfer
     *
     * @return \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer
     */
    public function mapEntityToTransfer(
        SpySalesPaymentMethodType $paymentMethodType,
        SalesPaymentMethodTypeTransfer $salesPaymentMethodTypeTransfer
    ): SalesPaymentMethodTypeTransfer {
        $salesPaymentMethodTypeTransfer->setIdSalesPaymentMethodType($paymentMethodType->getIdSalesPaymentMethodType());
        $salesPaymentMethodTypeTransfer->setPaymentMethod((new PaymentMethodTransfer())->setName($paymentMethodType->getPaymentMethod()));
        $salesPaymentMethodTypeTransfer->setPaymentProvider((new PaymentProviderTransfer())->setName($paymentMethodType->getPaymentProvider()));

        return $salesPaymentMethodTypeTransfer;
    }
}
