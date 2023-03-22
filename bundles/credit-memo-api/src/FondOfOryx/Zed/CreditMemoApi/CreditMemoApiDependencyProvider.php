<?php

namespace FondOfOryx\Zed\CreditMemoApi;

use FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToApiFacadeBridge;
use FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CreditMemoApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_API = 'FACADE_API';

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

        $container = $this->addApiFacade($container);

        return $this->addCreditMemoFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new CreditMemoApiToApiFacadeBridge($container->getLocator()->api()->facade());
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
                $container->getLocator()->creditMemo()->facade(),
            );
        };

        return $container;
    }
}
