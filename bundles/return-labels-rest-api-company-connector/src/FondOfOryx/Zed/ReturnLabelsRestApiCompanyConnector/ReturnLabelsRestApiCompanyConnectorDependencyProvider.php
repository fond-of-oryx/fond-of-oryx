<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector;

use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiCompanyConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY = 'PROPEL_QUERY_COMPANY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addCompanyPropelQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY] = static function () {
            return SpyCompanyQuery::create();
        };

        return $container;
    }
}
