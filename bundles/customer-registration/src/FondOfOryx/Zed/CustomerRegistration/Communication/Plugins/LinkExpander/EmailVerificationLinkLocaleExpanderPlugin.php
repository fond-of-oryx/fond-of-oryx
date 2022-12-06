<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface getConfig()
 */
class EmailVerificationLinkLocaleExpanderPlugin extends AbstractPlugin implements EmailVerificationLinkExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const LOCALE_PATTERN = '{{locale}}';

    /**
     * @param string $link
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function expand(string $link, CustomerTransfer $customerTransfer): string
    {
        return str_replace(static::LOCALE_PATTERN, $this->getLocaleKey($customerTransfer->getLocale()), $link);
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @return string
     */
    protected function getLocaleKey(?LocaleTransfer $localeTransfer = null): string
    {
        $currentLocale = $this->getFactory()->getLocaleFacade()->getCurrentLocaleName();

        if ($localeTransfer !== null) {
            $currentLocale = $localeTransfer->getLocaleName();
        }

        $availableLocaleIsoCodes = $this->getFactory()->getStoreFacade()->getCurrentStore()->getAvailableLocaleIsoCodes();

        $urlLocale = array_search($currentLocale, $availableLocaleIsoCodes, true);

        if (!$urlLocale) {
            return $this->getConfig()->getFallbackUrlLanguageKey();
        }

        return $urlLocale;
    }
}
