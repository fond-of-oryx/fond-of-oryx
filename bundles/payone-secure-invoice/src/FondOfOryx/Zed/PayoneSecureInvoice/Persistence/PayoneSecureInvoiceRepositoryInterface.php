<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Persistence;

interface PayoneSecureInvoiceRepositoryInterface
{
    /**
     * @param int $transactionId
     *
     * @return string|null
     */
    public function getPaymentMethodByTxId(int $transactionId): ?string;
}
