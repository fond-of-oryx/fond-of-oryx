<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander\EmailVerificationLinkLocaleExpanderPlugin;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToCustomerQueryContainerBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToLocaleQueryContainerBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var int
     */
    protected const BCRYPT_FACTOR = 12;

    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const FACADE_SEQUENCE_NUMBER = 'FACADE_SEQUENCE_NUMBER';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_LOCALE = 'QUERY_CONTAINER_LOCALE';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_CUSTOMER = 'QUERY_CONTAINER_CUSTOMER';

    /**
     * @var string
     */
    public const SERVICE_UTIL_TEXT_SERVICE = 'SERVICE_UTIL_TEXT_SERVICE';

    /**
     * @var string
     */
    public const PLUGINS_CUSTOMER_REGISTRATION_PROCESSOR = 'PLUGINS_CUSTOMER_REGISTRATION_PROCESSOR';

    /**
     * @var string
     */
    public const PLUGINS_CUSTOMER_REGISTRATION_POST = 'PLUGINS_CUSTOMER_REGISTRATION_POST';

    /**
     * @var string
     */
    public const PLUGINS_GDPR_PRE = 'PLUGINS_GDPR_PRE';

    /**
     * @var string
     */
    public const PLUGINS_GDPR_POST = 'PLUGINS_GDPR_POST';

    /**
     * @var string
     */
    public const PLUGINS_MAIL_VERIFICATION_PRE = 'PLUGINS_MAIL_VERIFICATION_PRE';

    /**
     * @var string
     */
    public const PLUGINS_MAIL_VERIFICATION_POST = 'PLUGINS_MAIL_VERIFICATION_POST';

    /**
     * @var string
     */
    public const PLUGINS_EMAIL_VERIFICATION_LINK_EXTENDER = 'PLUGINS_EMAIL_VERIFICATION_LINK_EXTENDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCustomerFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addSequenceNumberFacade($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addUtilTextService($container);
        $container = $this->addCustomerRegistrationProcessorPlugins($container);
        $container = $this->addCustomerRegistrationPostPlugins($container);
        $container = $this->addGdprPreConditionPlugins($container);
        $container = $this->addGdprPostPlugins($container);
        $container = $this->addMailVerificationPreConditionPlugins($container);
        $container = $this->addMailVerificationPostPlugins($container);
        $container = $this->addEmailVerificationLinkExtenderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addCustomerFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addLocaleQueryContainer($container);
        $container = $this->addCustomerQueryContainer($container);
        $container = $this->addLocaleFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = static function (Container $container) {
            return new CustomerRegistrationToCustomerFacadeBridge(
                $container->getLocator()->customer()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = static function (Container $container) {
            return new CustomerRegistrationToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_LOCALE] = static function (Container $container) {
            return new CustomerRegistrationToLocaleQueryContainerBridge(
                $container->getLocator()->locale()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_CUSTOMER] = static function (Container $container) {
            return new CustomerRegistrationToCustomerQueryContainerBridge(
                $container->getLocator()->customer()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSequenceNumberFacade(Container $container): Container
    {
        $container[static::FACADE_SEQUENCE_NUMBER] = static function (Container $container) {
            return new CustomerRegistrationToSequenceNumberFacadeBridge(
                $container->getLocator()->sequenceNumber()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new CustomerRegistrationToStoreFacadeBridge(
                $container->getLocator()->store()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilTextService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_TEXT_SERVICE] = static function (Container $container) {
            return new CustomerRegistrationToUtilTextServiceBridge(
                $container->getLocator()->utilText()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerRegistrationProcessorPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_CUSTOMER_REGISTRATION_PROCESSOR] = static function () use ($self) {
            return $self->getCustomerRegistrationProcessorPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerRegistrationPostPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_CUSTOMER_REGISTRATION_POST] = static function () use ($self) {
            return $self->getCustomerRegistrationPostPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGdprPreConditionPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_GDPR_PRE] = static function () use ($self) {
            return $self->getGdprPreConditionPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGdprPostPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_GDPR_POST] = static function () use ($self) {
            return $self->getGdprPostPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailVerificationPreConditionPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_MAIL_VERIFICATION_PRE] = static function () use ($self) {
            return $self->getMailVerificationPreConditionPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailVerificationPostPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_MAIL_VERIFICATION_POST] = static function () use ($self) {
            return $self->getMailVerificationPostPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEmailVerificationLinkExtenderPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_EMAIL_VERIFICATION_LINK_EXTENDER] = static function () use ($self) {
            return $self->getEmailVerificationLinkExtenderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface>
     */
    protected function getCustomerRegistrationProcessorPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getCustomerRegistrationPostPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getGdprPreConditionPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getGdprPostPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getMailVerificationPreConditionPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getMailVerificationPostPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface>
     */
    protected function getEmailVerificationLinkExtenderPlugins(): array
    {
        return [
            new EmailVerificationLinkLocaleExpanderPlugin(),
        ];
    }
}
