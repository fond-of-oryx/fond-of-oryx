<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

interface ProductLocaleRestrictionStorageToLocaleClientInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale(): string;
}
