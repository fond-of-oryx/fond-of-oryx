<?php

namespace FondOfOryx\Zed\CompaniesRestApi;

use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompaniesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_DELETER = 'FACADE_COMPANY_DELETER';

    /** @var string */
    public const QUERY_SPY_COMPANY = 'QUERY_SPY_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addCompanyDeleterFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addSpyCompanyQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyDeleterFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_DELETER] = static function (Container $container) {
            return new CompaniesRestApiToCompanyDeleterFacadeBridge(
                $container->getLocator()->companyDeleter()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCompanyQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY] = static function () {
            return new SpyCompanyQuery();
        };

        return $container;
    }
}
