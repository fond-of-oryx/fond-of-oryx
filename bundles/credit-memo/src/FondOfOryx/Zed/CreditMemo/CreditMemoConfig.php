<?php

namespace FondOfOryx\Zed\CreditMemo;

use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CreditMemoConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getReferenceEnvironmentPrefix(): ?string
    {
        return $this->get(CreditMemoConstants::REFERENCE_ENVIRONMENT_PREFIX, null);
    }

    /**
     * @return string|null
     */
    public function getReferencePrefix(): ?string
    {
        return $this->get(CreditMemoConstants::REFERENCE_PREFIX, null);
    }

    /**
     * @return int|null
     */
    public function getReferenceOffset(): ?int
    {
        return $this->get(CreditMemoConstants::REFERENCE_OFFSET, null);
    }

    /**
     * @return int
     */
    public function getProcessSizeMax(): int
    {
        return $this->get(CreditMemoConstants::PROCESS_SIZE_MAX, 25);
    }
}
