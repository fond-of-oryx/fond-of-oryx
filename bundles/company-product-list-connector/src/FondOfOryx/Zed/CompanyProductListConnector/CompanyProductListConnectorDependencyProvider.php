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
     * @var string
     */
    public const PLUGINS_COMPANY_PRODUCT_LIST_RELATION_POST_PERSIST = 'PLUGINS_COMPANY_PRODUCT_LIST_RELATION_POST_PERSIST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addCompanyProductListRelationPostPersistPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyProductListRelationPostPersistPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_COMPANY_PRODUCT_LIST_RELATION_POST_PERSIST] = static function () use ($self) {
            return $self->getCompanyProductListRelationPostPersistPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface>
     */
    protected function getCompanyProductListRelationPostPersistPlugins(): array
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
