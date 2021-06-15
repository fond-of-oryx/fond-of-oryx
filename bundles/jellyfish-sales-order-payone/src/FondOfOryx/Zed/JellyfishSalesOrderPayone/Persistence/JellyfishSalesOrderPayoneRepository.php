<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence;

use Generated\Shared\Transfer\PayonePaymentTransfer;
use Generated\Shared\Transfer\SalesPaymentTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayonePersistenceFactory getFactory()
 */
class JellyfishSalesOrderPayoneRepository extends AbstractRepository implements JellyfishSalesOrderPayoneRepositoryInterface
{
    /**
     * @param int $idSalesPayment
     *
     * @return \Generated\Shared\Transfer\SalesPaymentTransfer|null
     */
    public function findSalesPaymentByIdSalesPayment(int $idSalesPayment): ?SalesPaymentTransfer
    {
        $salesPaymentEntity = $this->getFactory()->createSalesPaymentQuery()
            ->filterByIdSalesPayment($idSalesPayment)->findOne();

        if ($salesPaymentEntity === null) {
            return null;
        }

        return (new SalesPaymentTransfer())->fromArray($salesPaymentEntity->toArray(), true);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\PayonePaymentTransfer|null
     */
    public function findPaymentPayoneByIdSalesOrder(int $idSalesOrder): ?PayonePaymentTransfer
    {
        $payonePaymentEntity = $this->getFactory()->createPaymentPayoneQuery()
            ->filterByFkSalesOrder($idSalesOrder)->findOne();

        if ($payonePaymentEntity === null) {
            return null;
        }

        return (new PayonePaymentTransfer())->fromArray($payonePaymentEntity->toArray(), true);
    }

    /**
     * @param int $idSalesPayment
     *
     * @return string
     */
    public function findPaymentTransactionIdByIdSalesPayment(int $idSalesPayment): string
    {
        $salesPaymentTransfer = $this->findSalesPaymentByIdSalesPayment($idSalesPayment);

        if ($salesPaymentTransfer === null || $salesPaymentTransfer->getFkSalesOrder() === null) {
            return '';
        }

        $paymentPayoneTransfer = $this->findPaymentPayoneByIdSalesOrder($salesPaymentTransfer->getFkSalesOrder());

        if ($paymentPayoneTransfer === null || $paymentPayoneTransfer->getTransactionId() === null) {
            return '';
        }

        return (string)$paymentPayoneTransfer->getTransactionId();
    }
}
