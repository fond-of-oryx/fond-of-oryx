<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserBridge;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class RepresentativeCompanyUserTradeFairDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_UUID_GENERATOR = 'SERVICE_UTIL_UUID_GENERATOR';

    /**
     * @var string
     */
    public const FACADE_REPRESENTATIVE_COMPANY_USER = 'FACADE_REPRESENTATIVE_COMPANY_USER';

    /**
     * @var string
     */
    public const QUERY_COMPANY = 'QUERY_COMPANY';

    /**
     * @var string
     */
    public const QUERY_CUSTOMER = 'QUERY_CUSTOMER';

    /**
     * @var string
     */
    public const QUERY_COMPANY_ROLE = 'QUERY_COMPANY_ROLE';

    /**
     * @var string
     */
    public const QUERY_REPRESENTATIVE_COMPANY_USER = 'QUERY_REPRESENTATIVE_COMPANY_USER';

    /**
     * @var string
     */
    public const PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_EXPANDER = 'PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addRepresentativeCompanyUserFacade($container);

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
        $container = $this->addRepresentativeCompanyUserQuery($container);
        $container = $this->addCustomerQuery($container);
        $container = $this->addCompanyRoleQuery($container);
        $container = $this->addFooRepresentativeCompanyUserQueryExpanderPlugins($container);

        return $this->addCompanyQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilUuidGeneratorService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_UUID_GENERATOR] = static function (Container $container) {
            return new RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceBridge(
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
    protected function addRepresentativeCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_REPRESENTATIVE_COMPANY_USER] = static function (Container $container) {
            return new RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserBridge(
                $container->getLocator()->representativeCompanyUser()->facade(),
            );
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
    protected function addCustomerQuery(Container $container): Container
    {
        $container[static::QUERY_CUSTOMER] = static function (Container $container) {
            return new SpyCustomerQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRepresentativeCompanyUserQuery(Container $container): Container
    {
        $container[static::QUERY_REPRESENTATIVE_COMPANY_USER] = static function (Container $container) {
            return new FooRepresentativeCompanyUserQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyRoleQuery(Container $container): Container
    {
        $container[static::QUERY_COMPANY_ROLE] = static function (Container $container) {
            return new SpyCompanyRoleQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addFooRepresentativeCompanyUserQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_EXPANDER] = static function (Container $container) use ($self) {
            return $self->getFooRepresentativeCompanyUserTradeFairQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairExtension\Dependency\Plugin\Persistence\RepresentativeCompanyUserTradeFairQueryExpanderPluginInterface[]
     */
    public function getFooRepresentativeCompanyUserTradeFairQueryExpanderPlugins(): array
    {
        return [];
    }
}
