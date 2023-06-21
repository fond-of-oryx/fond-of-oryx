<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiFactory getFactory()
 */
class NotionProxyRestApiClient extends AbstractClient implements NotionProxyRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    public function sendRequest(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): RestNotionProxyRequestResponseTransfer {
        return $this->getFactory()
            ->createRequestClient()
            ->send($restNotionProxyRequestAttributesTransfer);
    }
}
