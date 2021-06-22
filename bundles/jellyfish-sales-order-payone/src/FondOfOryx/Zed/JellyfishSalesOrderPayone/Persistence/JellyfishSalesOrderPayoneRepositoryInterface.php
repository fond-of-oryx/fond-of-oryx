<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence;

use Generated\Shared\Transfer\PayonePaymentTransfer;
use Generated\Shared\Transfer\SalesPaymentTransfer;

interface JellyfishSalesOrderPayoneRepositoryInterface
{
    /**
     * @param int $idSalesPayment
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\SalesPaymentTransfer|null
     */
    public function findSalesPaymentByIdSalesPayment(int $idSalesPayment): ?SalesPaymentTransfer;

    /**
     * @param int $idSalesOrder
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\PayonePaymentTransfer|null
     */
    public function findPaymentPayoneByIdSalesOrder(int $idSalesOrder): ?PayonePaymentTransfer;

    /**
     * @param int $idSalesPayment
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return string
     */
    public function findPaymentTransactionIdByIdSalesPayment(int $idSalesPayment): string;
}
