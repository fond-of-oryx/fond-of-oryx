<?php

namespace FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin;

use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

interface UrlFormatterPluginInterface
{
    /**
     * @param string $path
     * @param string $encodedCredentials
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer $attributesTransfer
     *
     * @return string
     */
    public function formatUrl(string $path, string $encodedCredentials, OneTimePasswordAttributesTransfer $attributesTransfer): string;
}
