<?php

namespace FondOfOryx\Service\Trbo\Api;

use Symfony\Component\HttpFoundation\Request;

interface TrboApiConfigurationInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function getConfiguration(Request $request): array;

    /**
     * @return string
     */
    public function getApiUrl(): string;
}
