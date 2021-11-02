<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business;

use FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface;
use FondOfOryx\Zed\DeliveryDateRestriction\DeliveryDateRestrictionDependencyProvider;
use FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class DeliveryDateRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->createQuoteValidator(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator(
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): DeliveryDateRestrictionToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(DeliveryDateRestrictionDependencyProvider::FACADE_PERMISSION);
    }
}
