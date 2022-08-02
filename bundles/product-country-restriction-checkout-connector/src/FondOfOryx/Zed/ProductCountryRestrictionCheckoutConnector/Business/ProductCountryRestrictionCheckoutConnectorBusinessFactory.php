<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReader;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Validator\QuoteValidatorInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductCountryRestrictionCheckoutConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Validator\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator($this->createCountryReader());
    }

    /**
     * @return \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface
     */
    public function createCountryReader(): BlacklistedCountryReaderInterface
    {
        return new BlacklistedCountryReader($this->getProductCountryRestrictionFacade());
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
