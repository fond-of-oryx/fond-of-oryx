<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client;

interface CompanyUserSearchRestApiToGlossaryStorageClientInterface
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
