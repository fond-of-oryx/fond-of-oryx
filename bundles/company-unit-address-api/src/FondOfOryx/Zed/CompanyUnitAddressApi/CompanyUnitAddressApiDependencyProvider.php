<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi;

use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeBridge;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerBridge;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerBridge;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyUnitAddressApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_UNIT_ADDRESS = 'FACADE_COMPANY_UNIT_ADDRESS';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_UNIT_ADDRESS = 'PROPEL_QUERY_COMPANY_UNIT_ADDRESS';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyUnitAddressFacade($container);

        return $this->addApiQueryContainer($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addApiQueryContainer($container);
        $container = $this->addApiQueryBuilderQueryContainer($container);

        return $this->addCompanyUnitAddressPropelQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_UNIT_ADDRESS] = static function (Container $container) {
            return new CompanyUnitAddressApiToCompanyUnitAddressFacadeBridge(
                $container->getLocator()->companyUnitAddress()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_UNIT_ADDRESS] = static function () {
            return SpyCompanyUnitAddressQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = static function (Container $container) {
            return new CompanyUnitAddressApiToApiQueryContainerBridge(
                $container->getLocator()->api()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = static function (Container $container) {
            return new CompanyUnitAddressApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }
}
