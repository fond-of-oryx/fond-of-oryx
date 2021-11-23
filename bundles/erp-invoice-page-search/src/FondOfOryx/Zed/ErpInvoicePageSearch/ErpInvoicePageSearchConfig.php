<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ErpInvoicePageSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string|null
     */
    public function getErpInvoicePageSynchronizationPoolName(): ?string
    {
        return null;
    }

    /**
     * @api
     *
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return null;
    }
}
