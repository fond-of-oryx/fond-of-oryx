<?php

namespace FondOfOryx\Zed\CompanyProductListApi;

use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeBridge;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeBridge;
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
    public const FACADE_API = 'FACADE_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyProductListConnectorFacade($container);

        return $this->addApiFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyProductListConnectorFacade(Container $container)
    {
        $container[static::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
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
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new CompanyProductListApiToApiFacadeBridge($container->getLocator()->api()->facade());
        };

        return $container;
    }
}
