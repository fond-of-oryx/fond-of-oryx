<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListBusinessFactory getFactory()
 */
class VertigoPriceProductPriceListFacade extends AbstractFacade implements VertigoPriceProductPriceListFacadeInterface
{
    /**
     * @return void
     */
    public function requestMissingPriceProductPriceList(): void
    {
        $this->getFactory()
            ->createPriceProductPriceListRequester()
            ->requestAllMissing();
    }

    /**
     * @param string $sku
     *
     * @return void
     */
    public function requestPriceProductPriceListBySku(string $sku): void
    {
        $this->getFactory()
            ->createPriceProductPriceListRequester()
            ->requestBySku($sku);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function requestMissingPriceProductPriceListByProductConcrete(
        ProductConcreteTransfer $productConcreteTransfer
    ): void {
        $this->getFactory()
            ->createPriceProductPriceListRequester()
            ->requestMissingByProductConcrete($productConcreteTransfer);
    }
}
