<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser;

use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeBridge;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeBridge;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilDateTimeServiceBridge;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class RepresentativeCompanyUserDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_UUID_GENERATOR = 'SERVICE_UTIL_UUID_GENERATOR';

    /**
     * @var string
     */
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_EVENT = 'FACADE_EVENT';

    /**
     * @var string
     */
    public const SERVICE_UTIL_DATE_TIME = 'SERVICE_UTIL_DATE_TIME';

    /**
     * @var string
     */
    public const PLUGINS_TASKS = 'PLUGINS_TASKS';

    /**
     * @var string
     */
    public const PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_EXPANDER = 'PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_EXPANDER';

    /**
     * @var string
     */
    public const QUERY_COMPANY_USER = 'QUERY_COMPANY_USER';

    /**
     * @var string
     */
    public const QUERY_COMPANY = 'QUERY_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addTaskPlugins($container);
        $container = $this->addCompanyUserFacade($container);
        $container = $this->addEventFacade($container);

        return $this->addUtilUuidGeneratorService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyQuery($container);
        $container = $this->addUtilDateTimeService($container);
        $container = $this->addFooRepresentativeCompanyUserQueryExpanderPlugins($container);

        return $this->addCompanyUserQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilUuidGeneratorService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_UUID_GENERATOR] = static function (Container $container) {
            return new RepresentativeCompanyUserToUtilUuidGeneratorServiceBridge(
                $container->getLocator()->utilUuidGenerator()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = static function (Container $container) {
            return new RepresentativeCompanyUserToCompanyUserFacadeBridge(
                $container->getLocator()->companyUser()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT] = static function (Container $container) {
            return new RepresentativeCompanyUserToEventFacadeBridge(
                $container->getLocator()->event()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserQuery(Container $container): Container
    {
        $container[static::QUERY_COMPANY_USER] = static function (Container $container) {
            return new SpyCompanyUserQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyQuery(Container $container): Container
    {
        $container[static::QUERY_COMPANY] = static function (Container $container) {
            return new SpyCompanyQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilDateTimeService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_DATE_TIME] = static function (Container $container) {
            return new RepresentativeCompanyUserToUtilDateTimeServiceBridge(
                $container->getLocator()->utilDateTime()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTaskPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_TASKS] = static function (Container $container) use ($self) {
            return $self->getTaskPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface>
     */
    protected function getTaskPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addFooRepresentativeCompanyUserQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_EXPANDER] = static function (Container $container) use ($self) {
            return $self->getFooRepresentativeCompanyUserQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\Persistence\RepresentativeCompanyUserQueryExpanderPluginInterface[]
     */
    public function getFooRepresentativeCompanyUserQueryExpanderPlugins(): array
    {
        return [];
    }
}
