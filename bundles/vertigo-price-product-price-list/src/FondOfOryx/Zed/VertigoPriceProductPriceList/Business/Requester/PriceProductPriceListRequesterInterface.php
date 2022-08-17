<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

interface PriceProductPriceListRequesterInterface
{
    /**
     * @return void
     */
    public function requestAllMissing(): void;
}
