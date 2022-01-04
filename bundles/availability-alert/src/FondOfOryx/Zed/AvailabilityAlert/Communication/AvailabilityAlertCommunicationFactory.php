<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication;

use FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionSubmitMapper;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpander;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpanderInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface getRepository()
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
            $this->getStoreFacade(),
            $this->createAvailabilityAlertSubscriptionTransferExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpanderInterface
     */
    public function createAvailabilityAlertSubscriptionTransferExpander(): AvailabilityAlertSubscriptionTransferExpanderInterface
    {
        return new AvailabilityAlertSubscriptionTransferExpander($this->getAvailabilityAlertSubscriptionExpanderPlugins());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface
     */
    protected function getLocaleFacade(): AvailabilityAlertToLocaleInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface
     */
    protected function getStoreFacade(): AvailabilityAlertToStoreInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_STORE);
    }

    /**
     * @return array<int, \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Expander\AvailabilityAlertSubscriptionTransferExpanderPluginInterface>
     */
    protected function getAvailabilityAlertSubscriptionExpanderPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_TRANSFER_EXPANDER);
    }
}
