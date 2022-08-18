<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

interface VertigoPriceProductPriceListFacadeInterface
{
    /**
     * @return void
     */
    public function requestMissingPriceProductPriceList(): void;

    /**
     * @param string $sku
     *
     * @return void
     */
    public function requestPriceProductPriceListBySku(string $sku): void;
}
