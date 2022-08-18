<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

interface PriceProductPriceListRequesterInterface
{
    /**
     * @return void
     */
    public function requestAllMissing(): void;

    /**
     * @param string $sku
     *
     * @return void
     */
    public function requestBySku(string $sku): void;
}
