<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

interface SplittableCheckoutRestApiToGlossaryStorageClientInterface
{
    /**
     * @param string $id
     * @param string $localeName
     * @param array $parameters
     *
     * @return string
     */
    public function translate(string $id, string $localeName, array $parameters = []): string;
}
