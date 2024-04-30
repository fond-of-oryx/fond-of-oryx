<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi;

use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyUserSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_SEARCH_COMPANY_USER_QUERY_EXPANDER = 'PLUGINS_SEARCH_COMPANY_USER_QUERY_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_COMPANY_USER_TRANSFER_POST_MAP_EXPANDER = 'PLUGINS_COMPANY_USER_TRANSFER_POST_MAP_EXPANDER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_USER = 'PROPEL_QUERY_COMPANY_USER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addSearchCompanyUserQueryExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyUserTransferPostMapExpanderPlugins($container);

        return $this->addCompanyUserQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_USER] = static fn () => SpyCompanyUserQuery::create();

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchCompanyUserQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_SEARCH_COMPANY_USER_QUERY_EXPANDER] = fn () => $this->getSearchCompanyUserQueryExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface>
     */
    protected function getSearchCompanyUserQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserTransferPostMapExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_COMPANY_USER_TRANSFER_POST_MAP_EXPANDER] = fn () => $this->getCompanyUserTransferPostMapExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\CompanyUserTransferPostMapExpanderPluginInterface>
     */
    protected function getCompanyUserTransferPostMapExpanderPlugins(): array
    {
        return [];
    }
}
