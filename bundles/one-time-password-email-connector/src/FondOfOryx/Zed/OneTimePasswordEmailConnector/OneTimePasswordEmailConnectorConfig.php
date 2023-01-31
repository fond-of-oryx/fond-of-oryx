<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector;

use FondOfOryx\Shared\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OneTimePasswordEmailConnectorConfig extends AbstractBundleConfig
{
    /**
     * @example ['de_DE' => 100, 'en_US' => 200]
     *
     * @param string $locale
     *
     * @return int|null
     */
    public function getOneTimePasswordLoginLinkMailTemplateIdByLocale(string $locale): ?int
    {
        $oneTimePasswordLoginLinkMailTemplateIdByLocale = $this->get(
            OneTimePasswordEmailConnectorConstants::ONE_TIME_PASSWORD_EMAIL_LINK_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($oneTimePasswordLoginLinkMailTemplateIdByLocale[$locale])) {
            return $oneTimePasswordLoginLinkMailTemplateIdByLocale[$locale];
        }

        if (isset($oneTimePasswordLoginLinkMailTemplateIdByLocale[$this->getDefaultLocale()])) {
            return $oneTimePasswordLoginLinkMailTemplateIdByLocale[$this->getDefaultLocale()];
        }

        return null;
    }
}
