<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class SplittableCheckoutRestApiToGlossaryStorageClientBridge implements SplittableCheckoutRestApiToGlossaryStorageClientInterface
{
    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(
        GlossaryStorageClientInterface $glossaryStorageClient
    ) {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param string $id
     * @param string $locale
     * @param array $parameters
     *
     * @return string
     */
    public function translate(string $id, string $locale, array $parameters = [])
    {
        return $this->glossaryStorageClient->translate($id, $locale, $parameters);
    }
}
