<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ErpOrderPageSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string|null
     */
    public function getErpOrderPageSynchronizationPoolName(): ?string
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
