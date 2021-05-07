<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiCustomerConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_CUSTOMER_QUERY = 'PROPEL_QUERY_CUSTOMER_QUERY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCustomerQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CUSTOMER_QUERY] = static function () {
            return SpyCustomerQuery::create();
        };

        return $container;
    }
}
