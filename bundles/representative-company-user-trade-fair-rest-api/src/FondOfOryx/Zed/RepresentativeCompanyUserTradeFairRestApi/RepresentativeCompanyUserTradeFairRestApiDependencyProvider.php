<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeBridge;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeBridge;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY_USER = 'QUERY_SPY_COMPANY_USER';

    /**
     * @var string
     */
    public const QUERY_SPY_CUSTOMER = 'QUERY_SPY_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_REPRESENTATIVE_COMPANY_USER = 'FACADE_REPRESENTATIVE_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_COMPANY_TYPE = 'FACADE_COMPANY_TYPE';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PERMISSION = 'PROPEL_QUERY_PERMISSION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addSpyCompanyUserQuery($container);
        $container = $this->addSpyCustomerQuery($container);

        return $this->addPermissionQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addRepresentativeCompanyUserTradeFairFacade($container);

        return $this->addCompanyTypeFacade($container);
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
    protected function addSpyCompanyUserQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY_USER] = static function () {
            return new SpyCompanyUserQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRepresentativeCompanyUserTradeFairFacade(Container $container): Container
    {
        $container[static::FACADE_REPRESENTATIVE_COMPANY_USER] = static function (Container $container) {
            return new RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeBridge($container->getLocator()->representativeCompanyUserTradeFair()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_TYPE] = static function (Container $container) {
            return new RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeBridge(
                $container->getLocator()->companyType()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PERMISSION] = static function () {
            return SpyPermissionQuery::create();
        };

        return $container;
    }
}
