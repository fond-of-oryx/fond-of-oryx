<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Customer\CustomerConstants;
use Spryker\Shared\SequenceNumber\SequenceNumberConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerRegistrationConfig extends AbstractBundleConfig implements CustomerRegistrationConfigInterface
{
    /**
     * @api
     *
     * @param string $storeName
     *
     * @return \Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    public function getCustomerReferenceDefaults(string $storeName): SequenceNumberSettingsTransfer
    {
        $sequenceNumberSettingsTransfer = new SequenceNumberSettingsTransfer();

        $sequenceNumberSettingsTransfer->setName(CustomerConstants::NAME_CUSTOMER_REFERENCE);

        $sequenceNumberPrefixParts = [];
        $sequenceNumberPrefixParts[] = $this->get(CustomerRegistrationConstants::CUSTOMER_REFERENCE_PREFIX, $storeName);

        if ($this->get(SequenceNumberConstants::ENVIRONMENT_PREFIX) !== '') {
            $sequenceNumberPrefixParts[] = $this->get(SequenceNumberConstants::ENVIRONMENT_PREFIX);
        }

        $prefix = implode($this->getUniqueIdentifierSeparator(), $sequenceNumberPrefixParts) . $this->getUniqueIdentifierSeparator();

        $sequenceNumberSettingsTransfer->setPrefix($prefix);

        $offset = $this->get(CustomerRegistrationConstants::CUSTOMER_REFERENCE_OFFSET);
        if ($offset) {
            $sequenceNumberSettingsTransfer->setOffset($this->get(CustomerRegistrationConstants::CUSTOMER_REFERENCE_OFFSET));
        }

        return $sequenceNumberSettingsTransfer;
    }

    /**
     * @return string
     */
    public function getVerificationLinkPattern(): string
    {
        return $this->get(CustomerRegistrationConstants::CONFIG_PATTERN_VERIFICATION_LINK, CustomerRegistrationConstants::DEFAULT_PATTERN_VERIFICATION_LINK);
    }

    /**
     * @return string
     */
    public function getFallbackUrlLanguageKey(): string
    {
        return $this->get(CustomerRegistrationConstants::CONFIG_FALLBACK_URL_LOCALE, CustomerRegistrationConstants::DEFAULT_CONFIG_FALLBACK_URL_LOCALE);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->get(CustomerRegistrationConstants::CONFIG_BASE_URL, $this->get(ApplicationConstants::BASE_URL_YVES));
    }

    /**
     * @return string
     */
    protected function getUniqueIdentifierSeparator(): string
    {
        return '-';
    }

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
            CustomerRegistrationConstants::MAILJET_CUSTOMER_REGISTRATION_WELCOME_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($customerRegistrationWelcomeMailTemplateIdByLocale[$locale])) {
            return $customerRegistrationWelcomeMailTemplateIdByLocale[$locale];
        }

        return null;
    }
}
