<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client;

use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class OrderBudgetSearchRestApiToGlossaryStorageClientBridge implements OrderBudgetSearchRestApiToGlossaryStorageClientInterface
{
    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    protected GlossaryStorageClientInterface $glossaryStorageClient;

    /**
     * @param \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(GlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param string $id
     * @param string $localeName
     * @param array $parameters
     *
     * @return string
     */
    public function translate(string $id, string $localeName, array $parameters = []): string
    {
        return $this->glossaryStorageClient->translate($id, $localeName, $parameters);
    }
}
