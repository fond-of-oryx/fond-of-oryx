<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence;

interface InactiveQuoteItemFilterRepositoryInterface
{
    /**
     * @param string $storeName
     * @param array $skus
     *
     * @return array
     */
    public function getActiveSkusByStoreNameAndSkus(string $storeName, array $skus): array;
}
