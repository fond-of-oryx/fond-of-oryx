<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany;

use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderCompanyDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_USER_REFERENCE = 'FACADE_COMPANY_USER_REFERENCE';

    /**
     * @var string
     */
    public const FACADE_CURRENCY = 'FACADE_CURRENCY';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyUserReferenceFacade($container);
        $container = $this->addCurrencyFacade($container);

        return $this->addLocaleFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserReferenceFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER_REFERENCE] = static function (Container $container) {
            return new JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeBridge(
                $container->getLocator()->companyUserReference()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = static function (Container $container) {
            return new JellyfishSalesOrderCompanyToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCurrencyFacade(Container $container): Container
    {
        $container[static::FACADE_CURRENCY] = static function (Container $container) {
            return new JellyfishSalesOrderCompanyToCurrencyFacadeBridge(
                $container->getLocator()->currency()->facade(),
            );
        };

        return $container;
    }
}
