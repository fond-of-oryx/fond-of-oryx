<?php

namespace FondOfOryx\Glue\CompanySearchRestApi;

use FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanySearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_GLOSSARY_STORAGE = 'CLIENT_GLOSSARY_STORAGE';

    /**
     * @var string
     */
    public const PLUGINS_FILTER_FIELDS_EXPANDER = 'PLUGINS_FILTER_FIELDS_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_REST_COMPANY_SEARCH_RESULT_ITEM_EXPANDER = 'PLUGINS_REST_COMPANY_SEARCH_RESULT_ITEM_EXPANDER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addFilterFieldsExpanderPlugins($container);
        $container = $this->addRestCompanySearchResultItemExpanderPlugins($container);

        return $this->addGlossaryStorageClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addGlossaryStorageClient(Container $container): Container
    {
        $container[static::CLIENT_GLOSSARY_STORAGE] = static fn (
            Container $container
        ) => new CompanySearchRestApiToGlossaryStorageClientBridge(
            $container->getLocator()->glossaryStorage()->client(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addFilterFieldsExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_FILTER_FIELDS_EXPANDER] = fn () => $this->getFilterFieldsExpanderPlugins();

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addRestCompanySearchResultItemExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_REST_COMPANY_SEARCH_RESULT_ITEM_EXPANDER] = fn () => $this->getRestCompanySearchResultItemExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\RestCompanySearchResultItemExpanderPluginInterface>
     */
    protected function getRestCompanySearchResultItemExpanderPlugins(): array
    {
        return [];
    }
}
