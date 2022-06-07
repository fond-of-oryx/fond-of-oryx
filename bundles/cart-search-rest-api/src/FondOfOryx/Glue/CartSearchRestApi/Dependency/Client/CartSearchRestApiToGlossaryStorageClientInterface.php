<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Dependency\Client;

interface CartSearchRestApiToGlossaryStorageClientInterface
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
