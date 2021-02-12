<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ErpOrderPageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_ERP_ORDER_PAGE_SEARCH = 'CLIENT_ERP_ORDER_PAGE_SEARCH';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addErpOrderPageSearchClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addErpOrderPageSearchClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_ORDER_PAGE_SEARCH] = static function (Container $container) {
            return new ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge($container->getLocator()->erpOrderPageSearch()->client());
        };

        return $container;
    }
}
