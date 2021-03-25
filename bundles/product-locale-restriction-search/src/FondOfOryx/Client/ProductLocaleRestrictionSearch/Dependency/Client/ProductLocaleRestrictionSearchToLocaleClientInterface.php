<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client;

interface ProductLocaleRestrictionSearchToLocaleClientInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale(): string;
}
