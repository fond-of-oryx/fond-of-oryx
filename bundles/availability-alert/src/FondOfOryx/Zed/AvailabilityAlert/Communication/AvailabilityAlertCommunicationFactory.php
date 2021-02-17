<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication;

use FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionSubmitMapper;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface getFacade()
 */
class AvailabilityAlertCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionSubmitMapperInterface
     */
    public function createAvailabilityAlertSubscriptionSubmitMapper()
    {
        return new AvailabilityAlertSubscriptionSubmitMapper(
            $this->getLocaleFacade(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface
     */
    protected function getLocaleFacade()
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface
     */
    protected function getStoreFacade()
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_STORE);
    }
}
