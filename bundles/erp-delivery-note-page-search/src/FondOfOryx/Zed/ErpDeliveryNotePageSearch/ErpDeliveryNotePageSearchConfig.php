<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
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

    /**
     * @return array<string>
     */
    public function getFullTextFields(): array
    {
        return $this->get(ErpDeliveryNotePageSearchConstants::FULL_TEXT_FIELDS, []);
    }

    /**
     * @return array<string>
     */
    public function getFullTextBoostedFields(): array
    {
        return $this->get(ErpDeliveryNotePageSearchConstants::FULL_TEXT_BOOSTED_FIELDS, []);
    }
}
