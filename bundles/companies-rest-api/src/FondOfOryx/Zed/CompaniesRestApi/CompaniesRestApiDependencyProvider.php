<?php

namespace FondOfOryx\Zed\CompaniesRestApi;

use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeBridge;
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
    protected function addCompanyDeleterFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_DELETER] = static function (Container $container) {
            return new CompaniesRestApiToCompanyDeleterFacadeBridge(
                $container->getLocator()->companyDeleter()->facade(),
            );
        };

        return $container;
    }
}
