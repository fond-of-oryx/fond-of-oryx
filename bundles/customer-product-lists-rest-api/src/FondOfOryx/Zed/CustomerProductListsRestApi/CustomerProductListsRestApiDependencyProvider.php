<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi;

use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CustomerProductListsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_CUSTOMER = 'PROPEL_QUERY_CUSTOMER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST_CUSTOMER = 'PROPEL_QUERY_PRODUCT_LIST_CUSTOMER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCustomerQuery($container);

        return $this->addProductListCustomerQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CUSTOMER] = static function () {
            return SpyCustomerQuery::create();
        };

        return $container;
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
}
