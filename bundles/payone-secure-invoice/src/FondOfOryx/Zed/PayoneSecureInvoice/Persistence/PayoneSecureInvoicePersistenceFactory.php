<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Persistence;

use Orm\Zed\Payone\Persistence\SpyPaymentPayoneQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepositoryInterface getRepository()
 */
class PayoneSecureInvoicePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Payone\Persistence\SpyPaymentPayoneQuery
     */
    public function createSpyPaymentPayoneQuery(): SpyPaymentPayoneQuery
    {
        return SpyPaymentPayoneQuery::create();
    }
}
