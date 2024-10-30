<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander\Dependency\Client;

interface ProductStyleSearchExpanderToCatalogClientInterface
{
    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function catalogSearch(string $searchString, array $requestParameters): array;
}
