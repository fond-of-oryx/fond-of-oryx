<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication;

use FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface;
use FondOfOryx\Zed\InactiveQuoteItemFilter\InactiveQuoteItemFilterDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class InactiveQuoteItemFilterCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface
     */
    public function getMessengerFacade(): InactiveQuoteItemFilterToMessengerFacadeInterface
    {
        return $this->getProvidedDependency(InactiveQuoteItemFilterDependencyProvider::FACADE_MESSENGER);
    }
}
