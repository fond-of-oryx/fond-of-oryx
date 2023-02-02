<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
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

    /**
     * @return array<string>
     */
    public function getFullTextFields(): array
    {
        return $this->get(ErpInvoicePageSearchConstants::FULL_TEXT_FIELDS, []);
    }

    /**
     * @return array<string>
     */
    public function getFullTextBoostedFields(): array
    {
        return $this->get(ErpInvoicePageSearchConstants::FULL_TEXT_BOOSTED_FIELDS, []);
    }
}
