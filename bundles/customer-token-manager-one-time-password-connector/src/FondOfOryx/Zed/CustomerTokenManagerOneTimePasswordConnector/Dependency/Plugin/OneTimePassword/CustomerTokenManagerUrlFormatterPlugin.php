<?php

namespace FondOfOryx\Zed\CustomerTokenManagerOneTimePasswordConnector\Dependency\Plugin\OneTimePassword;

use FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

class CustomerTokenManagerUrlFormatterPlugin implements UrlFormatterPluginInterface
{
    /**
     * @var string
     */
    protected $pattern = '{{token}}';

    /**
     * @param string $path
     * @param string $encodedCredentials
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer $attributesTransfer
     *
     * @return string
     */
    public function formatUrl(string $path, string $encodedCredentials, OneTimePasswordAttributesTransfer $attributesTransfer): string
    {
        return str_replace($this->pattern, $encodedCredentials, $path);
    }
}
