<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;

interface NotionProxyRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    public function sendRequest(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): RestNotionProxyRequestResponseTransfer;
}
