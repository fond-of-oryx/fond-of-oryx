<?php

namespace FondOfOryx\Zed\BrandProductListConnector;

use Orm\Zed\BrandProduct\Persistence\Base\FosBrandProductQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class BrandProductListConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_BRAND_PRODUCT = 'PROPEL_QUERY_BRAND_PRODUCT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addBrandProductQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandProductQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_BRAND_PRODUCT] = static function () {
            return FosBrandProductQuery::create();
        };

        return $container;
    }
}
