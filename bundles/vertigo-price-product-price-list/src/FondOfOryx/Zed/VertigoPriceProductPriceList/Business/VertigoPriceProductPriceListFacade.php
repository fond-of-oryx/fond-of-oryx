<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

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
}
