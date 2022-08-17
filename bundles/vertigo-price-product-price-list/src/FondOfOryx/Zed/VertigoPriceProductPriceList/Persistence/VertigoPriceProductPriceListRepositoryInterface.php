<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence;

interface VertigoPriceProductPriceListRepositoryInterface
{
    /**
     * @return array<string>
     */
    public function getSkusWithoutPriceProductPriceList(): array;
}
