<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;

interface CreditMemoSalesPaymentMethodTypeMapperInterface
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
    ): SalesPaymentMethodTypeTransfer;
}
