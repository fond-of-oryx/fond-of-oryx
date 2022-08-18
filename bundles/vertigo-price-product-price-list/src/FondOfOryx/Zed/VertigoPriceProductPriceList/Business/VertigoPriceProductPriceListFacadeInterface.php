<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

use Generated\Shared\Transfer\ProductConcreteTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function requestMissingPriceProductPriceListByProductConcrete(
        ProductConcreteTransfer $productConcreteTransfer
    ): void;
}
