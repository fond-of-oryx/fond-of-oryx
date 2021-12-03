<?php

namespace FondOfOryx\Zed\CompanyProductListConnector;

use Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyProductListConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST_COMPANY = 'PROPEL_QUERY_PRODUCT_LIST_COMPANY';

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

        return $this->addProductListCompanyQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListCompanyQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT_LIST_COMPANY] = static function () {
            return SpyProductListCompanyQuery::create();
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
