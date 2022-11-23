<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class EmailVerificationLinkGenerator implements EmailVerificationLinkGeneratorInterface
{
    /**
     * @var string
     */
    protected const LOCALE_PATTERN = '{{locale}}';

    /**
     * @var string
     */
    protected const TOKEN_PATTERN = '{{token}}';

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface $config
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        CustomerRegistrationConfigInterface $config,
        CustomerRegistrationToStoreFacadeInterface $storeFacade,
        CustomerRegistrationToLocaleFacadeInterface $localeFacade
    ) {
        $this->config = $config;
        $this->storeFacade = $storeFacade;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function generateLink(CustomerTransfer $customerTransfer): string
    {
        $linkPattern = sprintf($this->cleanSlashes($this->config->getVerificationLinkPattern()), $this->cleanSlashes($this->config->getBaseUrl()));

        return $this->replaceTokenPattern(
            $this->replaceLocalePattern($linkPattern, $this->getLocaleKey($customerTransfer->getLocale())),
            $customerTransfer->getRegistrationKey(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @return string
     */
    protected function getLocaleKey(?LocaleTransfer $localeTransfer = null): string
    {
        $currentLocale = $this->localeFacade->getCurrentLocaleName();

        if ($localeTransfer !== null) {
            $currentLocale = $localeTransfer->getLocaleName();
        }

        $availableLocaleIsoCodes = $this->storeFacade->getCurrentStore()->getAvailableLocaleIsoCodes();

        $urlLocale = array_search($currentLocale, $availableLocaleIsoCodes, true);

        if (!$urlLocale) {
            return $this->config->getFallbackUrlLanguageKey();
        }

        return $urlLocale;
    }

    /**
     * @param string $pattern
     * @param string $locale
     *
     * @return string
     */
    protected function replaceLocalePattern(string $pattern, string $locale): string
    {
        return $this->replaceInPattern(static::LOCALE_PATTERN, $locale, $pattern);
    }

    /**
     * @param string $pattern
     * @param string $token
     *
     * @return string
     */
    protected function replaceTokenPattern(string $pattern, string $token): string
    {
        return $this->replaceInPattern(static::TOKEN_PATTERN, $token, $pattern);
    }

    /**
     * @param string $replace
     * @param string $with
     * @param string $pattern
     *
     * @return string
     */
    protected function replaceInPattern(string $replace, string $with, string $pattern): string
    {
        return str_replace($replace, $with, $pattern);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function cleanSlashes(string $string): string
    {
        return ltrim(rtrim($string, '/'), '/');
    }
}
