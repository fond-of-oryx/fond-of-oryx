<?php

namespace FondOfOryx\Zed\ProductListsRestApi;

use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeBridge;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class ProductListsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_LIST = 'FACADE_PRODUCT_LIST';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST = 'PROPEL_QUERY_PRODUCT_LIST';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_UPDATE_PRE_CHECK = 'PLUGINS_PRODUCT_LIST_UPDATE_PRE_CHECK';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_POST_UPDATE = 'PLUGINS_PRODUCT_LIST_POST_UPDATE';

    /**
     * @var string
     */
    public const PLUGINS_REST_PRODUCT_LIST_UPDATE_REQUEST_EXPANDER = 'PLUGINS_REST_PRODUCT_LIST_UPDATE_REQUEST_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductListFacade($container);
        $container = $this->addProductListUpdatePreCheckPlugins($container);
        $container = $this->addProductListPostUpdatePlugins($container);

        return $this->addRestProductListUpdateRequestExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_LIST] = static function (Container $container) {
            return new ProductListsRestApiToProductListFacadeBridge(
                $container->getLocator()->productList()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addProductListQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT_LIST] = static function () {
            return SpyProductListQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListUpdatePreCheckPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRODUCT_LIST_UPDATE_PRE_CHECK] = static function () use ($self) {
            return $self->getProductListUpdatePreCheckPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface>
     */
    protected function getProductListUpdatePreCheckPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListPostUpdatePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRODUCT_LIST_POST_UPDATE] = static function () use ($self) {
            return $self->getProductListPostUpdatePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface>
     */
    protected function getProductListPostUpdatePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRestProductListUpdateRequestExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_REST_PRODUCT_LIST_UPDATE_REQUEST_EXPANDER] = static function () use ($self) {
            return $self->getRestProductListUpdateRequestExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\RestProductListUpdateRequestExpanderPluginInterface>
     */
    protected function getRestProductListUpdateRequestExpanderPlugins(): array
    {
        return [];
    }
}
