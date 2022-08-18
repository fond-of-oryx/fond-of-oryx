<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

use Generated\Shared\Transfer\ProductConcreteTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function requestMissingByProductConcrete(ProductConcreteTransfer $productConcreteTransfer): void;
}
