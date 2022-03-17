<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector;

use Orm\Zed\Country\Persistence\Base\SpyCountryQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CountryOmsMailConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_COUNTRY = 'PROPEL_QUERY_COUNTRY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addCountryQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCountryQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COUNTRY] = static function () {
            return SpyCountryQuery::create();
        };

        return $container;
    }
}
