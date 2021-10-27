<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client;

interface CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface
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
