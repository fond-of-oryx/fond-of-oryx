<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Dependency\Client;

interface AvailabilityAlertToLocaleClientInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale(): string;
}
