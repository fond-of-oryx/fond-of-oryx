<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander;

interface ProductStyleSearchExpanderClientInterface
{
    /**
     * @param string $modelKey
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKeyAndStyleKey(string $modelKey, string $styleKey): ?array;

    /**
     * @param string $modelKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKey(string $modelKey): ?array;

    /**
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameStyleKey(string $styleKey): ?array;
}
