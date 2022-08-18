<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence;

interface VertigoPriceProductPriceListRepositoryInterface
{
    /**
     * @return array<string>
     */
    public function getSkusWithoutPriceProductPriceList(): array;

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function hasPriceProductPriceList(string $sku): bool;
}
