<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ErpDeliveryNotePageSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string|null
     */
    public function getErpDeliveryNotePageSynchronizationPoolName(): ?string
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
