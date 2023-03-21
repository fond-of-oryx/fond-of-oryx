<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business;

use FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\Notification\MailNotificationHandler;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandler;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheck;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheckInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheck;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheckInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManager;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandler;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation\ValidationPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation\ValidationPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToAvailabilityFacadeInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface getRepository()
 */
class AvailabilityAlertBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandlerInterface
     */
    public function createSubscriptionRequestHandler(): SubscriptionRequestHandlerInterface
    {
        return new SubscriptionRequestHandler(
            $this->createSubscriptionManager(),
            $this->createValidationPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface
     */
    protected function createSubscriptionManager(): SubscriptionManagerInterface
    {
        return new SubscriptionManager(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getStoreFacade(),
            $this->createAvailabilityAlertSubscriptionPluginExecutor(),
            $this->createAvailabilityAlertSubscriberPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface
     */
    public function createSubscribersNotifier(): SubscribersNotifierInterface
    {
        return new SubscribersNotifier(
            $this->getAvailabilityFacade(),
            $this->createNotificationHandler(),
            $this->createSubscriptionManager(),
            $this->getConfig()->getMinimalPercentageDifference(),
            $this->createSubscribersNotifierPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\Notification\MailNotificationHandler
     */
    public function createMailHandler(): MailNotificationHandler
    {
        return new MailNotificationHandler(
            $this->getMailFacade(),
            $this->getProductFacade(),
            $this->getConfig()->getBaseUrlSslYves(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation\ValidationPluginExecutorInterface
     */
    public function createValidationPluginExecutor(): ValidationPluginExecutorInterface
    {
        return new ValidationPluginExecutor(
            $this->getValidationPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandlerInterface
     */
    protected function createNotificationHandler(): NotificationHandlerInterface
    {
        return new NotificationHandler($this->getNotificationHandlerPlugins());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface
     */
    protected function createSubscribersNotifierPluginExecutor(): SubscribersNotifierPluginExecutorInterface
    {
        return new SubscribersNotifierPluginExecutor(
            $this->getSubscribersNotifierPreCheckPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface
     */
    public function createAvailabilityAlertSubscriberPluginExecutor(): AvailabilityAlertSubscriberPluginExecutorInterface
    {
        return new AvailabilityAlertSubscriberPluginExecutor(
            $this->getSubscriberPreSavePlugins(),
            $this->getSubscriberPostSavePlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface
     */
    public function createAvailabilityAlertSubscriptionPluginExecutor(): AvailabilityAlertSubscriptionPluginExecutorInterface
    {
        return new AvailabilityAlertSubscriptionPluginExecutor(
            $this->getSubscriptionPreSavePlugins(),
            $this->getSubscriptionPostSavePlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheckInterface
     */
    public function createSubscribersNotifierHasProductAssignedStoresCheck(): SubscribersNotifierHasProductAssignedStoresCheckInterface
    {
        return new SubscribersNotifierHasProductAssignedStoresCheck(
            $this->getProductFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheckInterface
     */
    public function createSubscribersNotifierProductAttributeIsInPastOrIsEmptyCheck(): SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheckInterface
    {
        return new SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheck(
            $this->getProductFacade(),
            $this->getConfig()->getProductAttributeForDateCheck(),
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
     * @return array<\FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface>
     */
    protected function getSubscribersNotifierPreCheckPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToAvailabilityFacadeInterface
     */
    protected function getAvailabilityFacade(): AvailabilityAlertToAvailabilityFacadeInterface
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

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface
     */
    protected function getStoreFacade(): AvailabilityAlertToStoreInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::FACADE_STORE);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface>
     */
    protected function getSubscriberPostSavePlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_SUBSCRIBER_POST_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface>
     */
    protected function getSubscriberPreSavePlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_SUBSCRIBER_PRE_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriptionPostSavePluginInterface>
     */
    protected function getSubscriptionPostSavePlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_SUBSCRIPTION_POST_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriptionPreSavePluginInterface>
     */
    protected function getSubscriptionPreSavePlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_SUBSCRIPTION_PRE_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface>
     */
    protected function getNotificationHandlerPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_AVAILABILITY_ALERT_NOTIFICATION);
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface>
     */
    protected function getValidationPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_AVAILABILITY_ALERT_VALIDATION);
    }
}
