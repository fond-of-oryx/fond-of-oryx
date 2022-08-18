<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList;

use Orm\Zed\Product\Persistence\Base\SpyProductQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class VertigoPriceProductPriceListDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT = 'PROPEL_QUERY_PRODUCT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addProductQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT] = static function () {
            return SpyProductQuery::create();
        };

        return $container;
    }
}
