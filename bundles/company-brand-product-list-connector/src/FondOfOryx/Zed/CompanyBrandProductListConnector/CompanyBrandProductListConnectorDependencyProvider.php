<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector;

use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeBridge;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyBrandProductListConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_BRAND_COMPANY = 'FACADE_BRAND_COMPANY';

    /**
     * @var string
     */
    public const FACADE_BRAND_PRODUCT_LIST_CONNECTOR = 'FACADE_BRAND_PRODUCT_LIST_CONNECTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $this->addBrandCompanyFacade($container);

        return $this->addBrandProductListConnector($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND_COMPANY] = static function (Container $container) {
            return new CompanyBrandProductListConnectorToBrandCompanyFacadeBridge(
                $container->getLocator()->brandCompany()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandProductListConnector(Container $container): Container
    {
        $container[static::FACADE_BRAND_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
            return new CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridge(
                $container->getLocator()->brandProductListConnector()->facade(),
            );
        };

        return $container;
    }
}
