<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business;

use FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\MailHandler;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheck;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheckInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheck;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheckInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManager;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandler;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use Spryker\Zed\Availability\Business\AvailabilityFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface getQueryContainer()
 */
class AvailabilityAlertBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandlerInterface
     */
    public function createSubscriptionRequestHandler(): SubscriptionRequestHandlerInterface
    {
        return new SubscriptionRequestHandler(
            $this->createSubscriptionManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface
     */
    protected function createSubscriptionManager(): SubscriptionManagerInterface
    {
        return new SubscriptionManager(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface
     */
    public function createSubscribersNotifer(): SubscribersNotifierInterface
    {
        return new SubscribersNotifier(
            $this->getAvailabilityFacade(),
            $this->createMailHandler(),
            $this->getQueryContainer(),
            $this->getConfig()->getMinimalPercentageDifference(),
            $this->createSubscribersNotifierPluginExecutor()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\MailHandler
     */
    protected function createMailHandler(): MailHandler
    {
        return new MailHandler(
            $this->getMailFacade(),
            $this->getProductFacade(),
            $this->getConfig()->getBaseUrlSslYves()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface
     */
    protected function createSubscribersNotifierPluginExecutor(): SubscribersNotifierPluginExecutorInterface
    {
        return new SubscribersNotifierPluginExecutor(
            $this->getSubscribersNotifierPreCheckPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheckInterface
     */
    public function createSubscribersNotifierHasProductAssignedStoresCheck(): SubscribersNotifierHasProductAssignedStoresCheckInterface
    {
        return new SubscribersNotifierHasProductAssignedStoresCheck(
            $this->getProductFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheckInterface
     */
    public function createSubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheck(): SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheckInterface
    {
        return new SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheck(
            $this->getProductFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface
     */
    protected function getMailFacade(): AvailabilityAlertToMailInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface[]
     */
    protected function getSubscribersNotifierPreCheckPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS);
    }

    /**
     * @return \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface
     */
    protected function getAvailabilityFacade(): AvailabilityFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_AVAILABILITY);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface
     */
    protected function getProductFacade(): AvailabilityAlertToProductInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_PRODUCT);
    }
}
