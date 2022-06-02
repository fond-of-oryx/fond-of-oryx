<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Persistence;

use Orm\Zed\Payone\Persistence\Map\SpyPaymentPayoneTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoicePersistenceFactory getFactory()
 */
class PayoneSecureInvoiceRepository extends AbstractRepository implements PayoneSecureInvoiceRepositoryInterface
{
    /**
     * @param int $transactionId
     *
     * @return string|null
     */
    public function getPaymentMethodByTxId(int $transactionId): ?string
    {
        /** @var string|null $paymentMethod */
        $paymentMethod = $this->getFactory()
                ->createSpyPaymentPayoneQuery()
                ->filterByTransactionId($transactionId)
                ->select([SpyPaymentPayoneTableMap::COL_PAYMENT_METHOD])
                ->findOne();

        return $paymentMethod;
    }
}
