<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class JellyfishCrossEngageToProductFacadeBridge implements JellyfishCrossEngageToProductFacadeInterface
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
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function getProductConcrete(string $sku): ProductConcreteTransfer
    {
        return $this->productFacade->getProductConcrete($sku);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @return array
     */
    public function getCombinedConcreteAttributes(ProductConcreteTransfer $productConcreteTransfer, ?LocaleTransfer $localeTransfer = null): array
    {
        return $this->productFacade->getCombinedConcreteAttributes($productConcreteTransfer, $localeTransfer);
    }
}
