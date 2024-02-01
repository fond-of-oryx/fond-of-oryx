<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeBridge;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeBridge;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class RepresentativeCompanyUserRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_SPY_CUSTOMER = 'QUERY_SPY_CUSTOMER';

    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY_USER = 'QUERY_SPY_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_REPRESENTATIVE_COMPANY_USER = 'FACADE_REPRESENTATIVE_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_REPRESENTATIVE_COMPANY_USER_REST_API_PERMISSION = 'FACADE_REPRESENTATIVE_COMPANY_USER_REST_API_PERMISSION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addSpyCompanyUserQuery($container);

        return $this->addSpyCustomerQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addRepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacade($container);

        return $this->addRepresentativeCompanyUserFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCustomerQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_CUSTOMER] = static function () {
            return new SpyCustomerQuery();
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
            return new RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeBridge($container->getLocator()->representativeCompanyUser()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_REPRESENTATIVE_COMPANY_USER_REST_API_PERMISSION] = static function (Container $container) {
            return new RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeBridge($container->getLocator()->representativeCompanyUserRestApiPermission()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpyCompanyUserQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY_USER] = static function (Container $container) {
            return SpyCompanyUserQuery::create();
        };

        return $container;
    }
}
