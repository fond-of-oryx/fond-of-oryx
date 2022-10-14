<?php

namespace FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin;

interface UrlFormatterPluginInterface
{
    /**
     * @param string $path
     * @param string $encodedCredentials
     * @return string
     */
    public function formatUrl(string $path, string $encodedCredentials): string;
}
