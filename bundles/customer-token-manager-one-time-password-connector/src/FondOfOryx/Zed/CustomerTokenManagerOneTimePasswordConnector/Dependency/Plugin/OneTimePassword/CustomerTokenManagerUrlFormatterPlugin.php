<?php

namespace FondOfOryx\Zed\CustomerTokenManagerOneTimePasswordConnector\Dependency\Plugin\OneTimePassword;

use FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface;

class CustomerTokenManagerUrlFormatterPlugin implements UrlFormatterPluginInterface
{
    /**
     * @var string
     */
    protected $pattern = '{{token}}';

    /**
     * @param string $path
     * @param string $encodedCredentials
     * @return string
     */
    public function formatUrl(string $path, string $encodedCredentials): string
    {
        return str_replace($this->pattern, $encodedCredentials, $path);
    }
}
