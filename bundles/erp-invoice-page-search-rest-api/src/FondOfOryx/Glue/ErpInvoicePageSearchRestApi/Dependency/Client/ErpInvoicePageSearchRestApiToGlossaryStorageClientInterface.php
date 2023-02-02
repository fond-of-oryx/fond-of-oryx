<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client;

interface ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface
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
