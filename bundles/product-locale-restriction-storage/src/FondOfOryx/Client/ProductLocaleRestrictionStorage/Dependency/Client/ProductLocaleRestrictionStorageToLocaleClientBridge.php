<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

use Spryker\Client\Locale\LocaleClientInterface;

class ProductLocaleRestrictionStorageToLocaleClientBridge implements
    ProductLocaleRestrictionStorageToLocaleClientInterface
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
