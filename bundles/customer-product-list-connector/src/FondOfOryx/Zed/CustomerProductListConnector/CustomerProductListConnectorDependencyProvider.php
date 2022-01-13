<?php

namespace FondOfOryx\Zed\CustomerProductListConnector;

use Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CustomerProductListConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST_CUSTOMER = 'PROPEL_QUERY_PRODUCT_LIST_CUSTOMER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST = 'PROPEL_QUERY_PRODUCT_LIST';

    /**
     * @var string
     */
    public const PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST = 'PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addCustomerProductListRelationPostPersistPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerProductListRelationPostPersistPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST] = static function () use ($self) {
            return $self->getCustomerProductListRelationPostPersistPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface>
     */
    protected function getCustomerProductListRelationPostPersistPlugins(): array
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

        $container = $this->addProductListQuery($container);

        return $this->addProductListCustomerQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListCustomerQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT_LIST_CUSTOMER] = static function () {
            return SpyProductListCustomerQuery::create();
        };

        return $container;
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
}
