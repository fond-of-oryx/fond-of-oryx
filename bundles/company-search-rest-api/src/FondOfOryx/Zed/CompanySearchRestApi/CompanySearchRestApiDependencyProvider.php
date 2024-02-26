<?php

namespace FondOfOryx\Zed\CompanySearchRestApi;

use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanySearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_COMPANY_EXPANDER = 'PLUGINS_COMPANY_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_SEARCH_COMPANY_QUERY_EXPANDER = 'PLUGINS_SEARCH_COMPANY_QUERY_EXPANDER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY = 'PROPEL_QUERY_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyExpanderPlugins($container);

        return $this->addSearchCompanyQueryExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_COMPANY_EXPANDER] = fn () => $this->getCompanyExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\CompanyExpanderPluginInterface>
     */
    protected function getCompanyExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchCompanyQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_SEARCH_COMPANY_QUERY_EXPANDER] = fn () => $this->getSearchCompanyQueryExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface>
     */
    protected function getSearchCompanyQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addCompanyQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY] = static fn () => SpyCompanyQuery::create();

        return $container;
    }
}
