<?php

namespace FondOfOryx\Zed\CompanyDeleter;

use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyDeleterDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_PRE_COMPANY_DELETER = 'PLUGINS_PRE_COMPANY_DELETER';

    /**
     * @var string
     */
    public const PLUGINS_POST_COMPANY_DELETER = 'PLUGINS_POST_COMPANY_DELETER';

    /**
     * @var string
     */
    public const FACADE_COMPANY = 'FACADE_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyFacade($container);
        $container = $this->addPreCompanyDeleterPlugins($container);
        $container = $this->addPostCompanyDeleterPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPreCompanyDeleterPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRE_COMPANY_DELETER, function () {
            return $this->getPreCompanyDeleterPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPostCompanyDeleterPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_POST_COMPANY_DELETER, function () {
            return $this->getPostCompanyDeleterPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = static function (Container $container) {
            return new CompanyDeleterToCompanyFacadeBridge(
                $container->getLocator()->company()->facade(),
            );
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface>
     */
    protected function getPreCompanyDeleterPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface>
     */
    protected function getPostCompanyDeleterPlugins(): array
    {
        return [];
    }
}
