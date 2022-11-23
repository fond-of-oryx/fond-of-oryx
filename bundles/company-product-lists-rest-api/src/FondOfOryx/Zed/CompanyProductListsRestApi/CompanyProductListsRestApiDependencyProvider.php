<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi;

use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyProductListsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY = 'PROPEL_QUERY_COMPANY';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST_COMPANY = 'PROPEL_QUERY_PRODUCT_LIST_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addCompanyQuery($container);

        return $this->addProductListCompanyQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY] = static function () {
            return SpyCompanyQuery::create();
        };

        return $container;
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
}
