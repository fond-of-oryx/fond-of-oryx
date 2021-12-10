<?php

namespace FondOfOryx\Zed\CustomerProductListConnector;

use Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

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
