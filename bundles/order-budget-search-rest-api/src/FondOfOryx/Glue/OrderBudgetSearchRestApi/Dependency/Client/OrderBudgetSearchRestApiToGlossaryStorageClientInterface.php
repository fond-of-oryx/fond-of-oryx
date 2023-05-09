<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client;

interface OrderBudgetSearchRestApiToGlossaryStorageClientInterface
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
