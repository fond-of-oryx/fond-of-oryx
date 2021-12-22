<?php

namespace FondOfOryx\Zed\Invoice;

use FondOfOryx\Shared\Invoice\InvoiceConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class InvoiceConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getReferenceEnvironmentPrefix(): ?string
    {
        return $this->get(InvoiceConstants::REFERENCE_ENVIRONMENT_PREFIX, null);
    }

    /**
     * @return string|null
     */
    public function getReferencePrefix(): ?string
    {
        return $this->get(InvoiceConstants::REFERENCE_PREFIX, null);
    }

    /**
     * @return int|null
     */
    public function getReferenceOffset(): ?int
    {
        return $this->get(InvoiceConstants::REFERENCE_OFFSET, null);
    }
}
