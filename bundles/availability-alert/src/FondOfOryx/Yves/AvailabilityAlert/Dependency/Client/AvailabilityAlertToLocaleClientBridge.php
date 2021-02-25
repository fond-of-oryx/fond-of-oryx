<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Dependency\Client;

use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class AvailabilityAlertToLocaleClientBridge implements AvailabilityAlertToLocaleClientInterface
{
    /**
     * @var \Spryker\Client\Locale\LocaleClientInterface
     */
    protected $client;

    /**
     * AvailabilityAlertToLocaleClientBridge constructor.
     *
     * @param  \Spryker\Client\Locale\LocaleClientInterface  $localeFacade
     */
    public function __construct(LocaleClientInterface $localeFacade)
    {
        $this->client = $localeFacade;
    }

    /**
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return $this->client->getCurrentLocale();
    }
}
