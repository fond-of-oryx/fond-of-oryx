<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PayoneSecureInvoiceConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->get(PayoneSecureInvoiceConstants::PAYONE_SECURE_INVOICE_CREDENTIALS, []);
    }
}
