<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ErpOrderPageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_ERP_ORDER_PAGE_SEARCH = 'CLIENT_ERP_ORDER_PAGE_SEARCH';

    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addErpOrderPageSearchClient($container);

        return $container;
    }

    /**
     * @param  \Spryker\Glue\Kernel\Container  $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addErpOrderPageSearchClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_ORDER_PAGE_SEARCH] = static function (Container $container) {
            return $container->getLocator()->erpOrderPageSearch()->client();
        };

        return $container;
    }
}
