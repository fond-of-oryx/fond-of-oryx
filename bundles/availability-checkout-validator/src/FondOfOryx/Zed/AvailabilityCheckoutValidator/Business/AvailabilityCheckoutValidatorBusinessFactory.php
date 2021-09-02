<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business;

use FondOfOryx\Zed\AvailabilityCheckoutValidator\AvailabilityCheckoutValidatorDependencyProvider;
use FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\QuoteAvailabilityValidator;
use FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\ValidatorInterface;
use FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AvailabilityCheckoutValidatorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\ValidatorInterface
     */
    public function createQuoteAvailabilityValidator(): ValidatorInterface
    {
        return new QuoteAvailabilityValidator($this->getAvailabilityCartDataExtenderFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface
     */
    protected function getAvailabilityCartDataExtenderFacade(): AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityCheckoutValidatorDependencyProvider::FACADE_AVAILABILITY_CART_CONNECTOR);
    }
}
