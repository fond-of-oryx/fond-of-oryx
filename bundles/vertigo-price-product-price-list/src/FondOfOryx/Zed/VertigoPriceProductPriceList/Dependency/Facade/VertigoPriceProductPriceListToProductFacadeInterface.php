<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade;

interface VertigoPriceProductPriceListToProductFacadeInterface
{
    /**
     * @param string $sku
     *
     * @return bool
     */
    public function hasProductConcrete(string $sku): bool;
}
