<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Dependency\Client;

use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class CartSearchRestApiToGlossaryStorageClientBridge implements CartSearchRestApiToGlossaryStorageClientInterface
{
 /**
  * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
  */
    protected $glossaryStorageClient;

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
