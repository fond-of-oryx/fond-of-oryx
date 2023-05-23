<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Spryker\Client\Kernel\AbstractBundleConfig;

/**
 * @method \FondOfOryx\Shared\NotionProxyRestApi\NotionProxyRestApiConfig getSharedConfig()
 */
class NotionProxyRestApiConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return array<string, mixed>
     */
    public function getClientConfig(): array
    {
        return $this->getSharedConfig()->getClientConfig();
    }
}
