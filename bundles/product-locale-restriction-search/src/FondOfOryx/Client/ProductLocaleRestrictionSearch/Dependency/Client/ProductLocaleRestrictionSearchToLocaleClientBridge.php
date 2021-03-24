<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client;

use Spryker\Client\Locale\LocaleClientInterface;

class ProductLocaleRestrictionSearchToLocaleClientBridge implements ProductLocaleRestrictionSearchToLocaleClientInterface
{
    /**
     * @var \Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClient;

    /**
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     */
    public function __construct(LocaleClientInterface $localeClient)
    {
        $this->localeClient = $localeClient;
    }

    /**
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return $this->localeClient->getCurrentLocale();
    }
}
