<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector;

use FondOfOryx\Shared\CustomerRegistrationEmailConnector\CustomerRegistrationEmailConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerRegistrationEmailConnectorConfig extends AbstractBundleConfig
{
    /**
     * @example ['de_DE' => 100, 'en_US' => 200]
     *
     * @param string $locale
     *
     * @return int|null
     */
    public function getCustomerRegistrationWelcomeMailTemplateIdByLocale(string $locale = 'en_US'): ?int
    {
        $customerRegistrationWelcomeMailTemplateIdByLocale = $this->get(
            CustomerRegistrationEmailConnectorConstants::MAILJET_CUSTOMER_REGISTRATION_WELCOME_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($customerRegistrationWelcomeMailTemplateIdByLocale[$locale])) {
            return $customerRegistrationWelcomeMailTemplateIdByLocale[$locale];
        }

        return null;
    }
}
