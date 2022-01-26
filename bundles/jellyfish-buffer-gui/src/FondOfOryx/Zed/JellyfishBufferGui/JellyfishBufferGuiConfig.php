<?php

namespace FondOfOryx\Zed\JellyfishBufferGui;

use FondOfOryx\Shared\JellyfishBufferGui\JellyfishBufferGuiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishBufferGuiConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getAnonymizationData(): array
    {
        return $this->get(JellyfishBufferGuiConstants::ANONYMIZATION_DATA, JellyfishBufferGuiConstants::ANONYMIZATION_DATA_DEFAULT);
    }
}
