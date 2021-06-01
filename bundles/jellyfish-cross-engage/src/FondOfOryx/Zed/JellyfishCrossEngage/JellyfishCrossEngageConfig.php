<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage;

use FondOfOryx\Shared\JellyfishCrossEngage\JellyfishCrossEngageConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishCrossEngageConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getDefaultLocaleName(): string
    {
        return $this->get(JellyfishCrossEngageConstants::DEFAULT_LOCALE_NAME, 'en_US');
    }

    /**
     * @return string
     */
    public function getCategoriesSeparator(): string
    {
        return $this->get(JellyfishCrossEngageConstants::CATEGORIES_SEPARATOR, ', ');
    }

    /**
     * @return string
     */
    public function getGenderAttributeKey(): string
    {
        return $this->get(JellyfishCrossEngageConstants::GENDER_ATTRIBUTE_KEY, 'gender');
    }
}
