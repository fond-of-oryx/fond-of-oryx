<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
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

    /**
     * @return array<string>
     */
    public function getFullTextFields(): array
    {
        return $this->get(ErpOrderPageSearchConstants::FULL_TEXT_FIELDS, []);
    }

    /**
     * @return array<string>
     */
    public function getFullTextBoostedFields(): array
    {
        return $this->get(ErpOrderPageSearchConstants::FULL_TEXT_BOOSTED_FIELDS, []);
    }
}
