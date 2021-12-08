<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui;

use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyFacadeBridge;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeBridge;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilEncodingServiceBridge;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilSanitizeServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyProductListConnectorGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY = 'FACADE_COMPANY';

    /**
     * @var string
     */
    public const FACADE_COMPANY_PRODUCT_LIST_CONNECTOR = 'FACADE_COMPANY_PRODUCT_LIST_CONNECTOR';

    /**
     * @var string
     */
    public const SERVICE_UTIL_SANITIZE = 'SERVICE_UTIL_SANITIZE';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addCompanyFacade($container);
        $container = $this->addCompanyProductListConnectorFacade($container);
        $container = $this->addUtilSanitizeService($container);

        return $this->addUtilEncodingService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = static function (Container $container) {
            return new CompanyProductListConnectorGuiToCompanyFacadeBridge(
                $container->getLocator()->company()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyProductListConnectorFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
            return new CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeBridge(
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
    protected function addUtilSanitizeService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_SANITIZE] = static function (Container $container) {
            return new CompanyProductListConnectorGuiToUtilSanitizeServiceBridge($container->getLocator()->utilSanitize()->service());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new CompanyProductListConnectorGuiToUtilEncodingServiceBridge($container->getLocator()->utilEncoding()->service());
        };

        return $container;
    }
}
