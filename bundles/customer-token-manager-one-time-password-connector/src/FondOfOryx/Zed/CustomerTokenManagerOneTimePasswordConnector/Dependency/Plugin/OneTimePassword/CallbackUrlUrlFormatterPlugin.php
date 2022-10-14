<?php

namespace FondOfOryx\Zed\CustomerTokenManagerOneTimePasswordConnector\Dependency\Plugin\OneTimePassword;

use FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

class CallbackUrlUrlFormatterPlugin implements UrlFormatterPluginInterface
{
    /**
     * @var string
     */
    protected $callbackUrlPrefix = 'callback_url';

    /**
     * @param string $path
     * @param string $encodedCredentials
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer $attributesTransfer
     *
     * @return string
     */
    public function formatUrl(string $path, string $encodedCredentials, OneTimePasswordAttributesTransfer $attributesTransfer): string
    {
        if ($attributesTransfer->getCallbackUrl() === null) {
            return $path;
        }

        if (parse_url($path, PHP_URL_QUERY)) {
            return sprintf('%s&%s=%s', $path, $this->callbackUrlPrefix, $attributesTransfer->getCallbackUrl());
        }

        return sprintf('%s?%s=%s', $path, $this->callbackUrlPrefix, $attributesTransfer->getCallbackUrl());
    }
}
