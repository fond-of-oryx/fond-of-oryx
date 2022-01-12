<?php

namespace FondOfOryx\Zed\InvoiceApi;

use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeBridge;
use FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class InvoiceApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    /**
     * @var string
     */
    public const FACADE_CREDIT_MEMO = 'FACADE_CREDIT_MEMO';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addApiQueryContainer($container);
        $container = $this->addInvoiceFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = static function (Container $container) {
            return new InvoiceApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addInvoiceFacade(Container $container): Container
    {
        $container[static::FACADE_CREDIT_MEMO] = static function (Container $container) {
            return new InvoiceApiToInvoiceFacadeBridge(
                $container->getLocator()->invoice()->facade(),
            );
        };

        return $container;
    }
}
