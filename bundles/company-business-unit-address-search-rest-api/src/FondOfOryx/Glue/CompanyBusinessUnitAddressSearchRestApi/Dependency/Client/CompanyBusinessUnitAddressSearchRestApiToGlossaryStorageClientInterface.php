<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client;

interface CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface
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
