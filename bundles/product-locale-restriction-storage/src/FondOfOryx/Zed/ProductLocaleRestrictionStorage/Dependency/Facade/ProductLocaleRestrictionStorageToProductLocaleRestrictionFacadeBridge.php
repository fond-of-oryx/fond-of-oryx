<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;

class ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge implements
    ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface
     */
    protected $productLocaleRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade
     */
    public function __construct(ProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade)
    {
        $this->productLocaleRestrictionFacade = $productLocaleRestrictionFacade;
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array
    {
        return $this->productLocaleRestrictionFacade->getBlacklistedLocalesByProductAbstractIds($productAbstractIds);
    }
}
