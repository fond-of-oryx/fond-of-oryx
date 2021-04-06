<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade;

use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;

class ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge implements
    ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
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
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array
    {
        return $this->productLocaleRestrictionFacade->getBlacklistedLocalesByProductAbstractIds($productAbstractIds);
    }
}
