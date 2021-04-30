<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business;

use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapter;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriberDispatcher;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriberDispatcherInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriptionDispatcher;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriptionDispatcherInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertDependencyProvider;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig getConfig()
 */
class JellyfishAvailabilityAlertBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriberDispatcherInterface
     */
    public function createAvailabilityAlertSubscriberDispatcher(): AvailabilityAlertSubscriberDispatcherInterface
    {
        return new AvailabilityAlertSubscriberDispatcher($this->createAvailabilityAlertAdapter());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher\AvailabilityAlertSubscriptionDispatcherInterface
     */
    public function createAvailabilityAlertSubscriptionDispatcher(): AvailabilityAlertSubscriptionDispatcherInterface
    {
        return new AvailabilityAlertSubscriptionDispatcher($this->createAvailabilityAlertAdapter());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface
     */
    protected function createAvailabilityAlertAdapter(): AvailabilityAlertAdapterInterface
    {
        return new AvailabilityAlertAdapter(
            $this->getUtilEncodingService(),
            $this->createHttpClient(),
            $this->getConfig(),
            $this->getStoreFacade(),
            $this->getLocaleFacade()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new HttpClient([
            'base_uri' => $this->getConfig()->getBaseUri(),
            'timeout' => $this->getConfig()->getTimeout(),
        ]);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): JellyfishAvailabilityAlertToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(JellyfishAvailabilityAlertDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface
     */
    protected function getStoreFacade(): JellyfishAvailabilityAlertToStoreFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishAvailabilityAlertDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): JellyfishAvailabilityAlertToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishAvailabilityAlertDependencyProvider::FACADE_LOCALE);
    }
}
