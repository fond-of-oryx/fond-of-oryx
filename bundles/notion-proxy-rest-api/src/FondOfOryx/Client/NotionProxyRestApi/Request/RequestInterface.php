<?php

namespace FondOfOryx\Client\NotionProxyRestApi\Request;

use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;

interface RequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    public function send(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): RestNotionProxyRequestResponseTransfer;
}
