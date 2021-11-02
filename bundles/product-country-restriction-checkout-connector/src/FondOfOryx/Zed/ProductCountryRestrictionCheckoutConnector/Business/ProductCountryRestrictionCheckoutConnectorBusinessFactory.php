<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidator;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidatorInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductCountryRestrictionCheckoutConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator(
            $this->getProductCountryRestrictionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
     */
    protected function getProductCountryRestrictionFacade(): ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(
            ProductCountryRestrictionCheckoutConnectorDependencyProvider::FACADE_PRODUCT_COUNTRY_RESTRICTION,
        );
    }
}
