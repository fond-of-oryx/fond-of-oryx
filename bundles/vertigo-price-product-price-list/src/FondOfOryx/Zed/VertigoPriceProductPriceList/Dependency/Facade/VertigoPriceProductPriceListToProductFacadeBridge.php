<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade;

use Spryker\Zed\Product\Business\ProductFacadeInterface;

class VertigoPriceProductPriceListToProductFacadeBridge implements VertigoPriceProductPriceListToProductFacadeInterface
{
    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     */
    public function __construct(ProductFacadeInterface $productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function hasProductConcrete(string $sku): bool
    {
        return $this->productFacade->hasProductConcrete($sku);
    }
}
