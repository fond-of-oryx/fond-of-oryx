<?php

namespace FondOfOryx\Zed\CompanyProductListApi;

use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeBridge;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer\CompanyProductListApiToApiQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyProductListApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_PRODUCT_LIST_CONNECTOR = 'FACADE_COMPANY_PRODUCT_LIST_CONNECTOR';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyProductListConnectorFacade($container);
        $container = $this->addApiQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyProductListConnectorFacade(Container $container)
    {
        $container[static::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR] = function (Container $container) {
            return new CompanyProductListApiToCompanyProductListConnectorFacadeBridge(
                $container->getLocator()->companyProductListConnector()->facade(),
            );
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
        $container[static::QUERY_CONTAINER_API] = function (Container $container) {
            return new CompanyProductListApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }
}
