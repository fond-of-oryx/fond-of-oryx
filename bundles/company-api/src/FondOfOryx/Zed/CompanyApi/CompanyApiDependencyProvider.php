<?php

namespace FondOfOryx\Zed\CompanyApi;

use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToApiFacadeBridge;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeBridge;
use FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryBuilderQueryContainerBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_API = 'FACADE_API';

    /**
     * @var string
     */
    public const FACADE_COMPANY = 'FACADE_COMPANY';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY = 'PROPEL_QUERY_COMPANY';

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

        $container = $this->addCompanyFacade($container);

        return $this->addApiFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addApiFacade($container);
        $container = $this->addApiQueryBuilderQueryContainer($container);

        return $this->addCompanyPropelQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = static function (Container $container) {
            return new CompanyApiToCompanyFacadeBridge($container->getLocator()->company()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY] = static function () {
            return SpyCompanyQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new CompanyApiToApiFacadeBridge($container->getLocator()->api()->facade());
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
            return new CompanyApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }
}
