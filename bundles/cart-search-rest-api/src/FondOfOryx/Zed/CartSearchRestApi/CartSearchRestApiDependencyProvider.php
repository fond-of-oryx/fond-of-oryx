<?php

namespace FondOfOryx\Zed\CartSearchRestApi;

use Orm\Zed\Quote\Persistence\SpyQuoteQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER = 'PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_QUOTE = 'PROPEL_QUERY_QUOTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addSearchQuoteQueryExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchQuoteQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER] = static function () use ($self) {
            return $self->getSearchQuoteQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    protected function getSearchQuoteQueryExpanderPlugins(): array
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

        return $this->addQuoteQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_QUOTE] = static function () {
            return SpyQuoteQuery::create();
        };

        return $container;
    }
}
