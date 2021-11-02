<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade;

use FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface;

class ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge implements
    ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface
     */
    protected $productCountryRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade
     */
    public function __construct(ProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade)
    {
        $this->productCountryRestrictionFacade = $productCountryRestrictionFacade;
    }

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCountriesByProductConcreteSkus(array $productConcreteSkus): array
    {
        return $this->productCountryRestrictionFacade->getBlacklistedCountriesByProductConcreteSkus(
            $productConcreteSkus,
        );
    }
}
