<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

interface SplittableCheckoutRestApiToGlossaryStorageClientInterface
{
    /**
     * @param string $id
     * @param string $locale
     * @param array $parameters
     *
     * @return string
     */
    public function translate(string $id, string $locale, array $parameters = []);
}
