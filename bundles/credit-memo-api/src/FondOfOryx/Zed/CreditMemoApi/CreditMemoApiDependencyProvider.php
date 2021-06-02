<?php

namespace FondOfOryx\Zed\CreditMemoApi;

use FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeBridge;
use FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CreditMemoApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';
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
        $container = $this->addCreditMemoFacade($container);

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
            return new CreditMemoApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoFacade(Container $container): Container
    {
        $container[static::FACADE_CREDIT_MEMO] = static function (Container $container) {
            return new CreditMemoApiToCreditMemoFacadeBridge(
                $container->getLocator()->creditMemo()->facade()
            );
        };

        return $container;
    }
}
