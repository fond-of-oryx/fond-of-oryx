<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector;

use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OmsCreditMemoGiftCardConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CREDIT_MEMO_GIFT_CARD_CONNECTOR = 'FACADE_CREDIT_MEMO_GIFT_CARD_CONNECTOR';

    /**
     * @var string
     */
    public const QUERY_CREDIT_MEMO_GIFT_CARD = 'QUERY_CREDIT_MEMO_GIFT_CARD';

    /**
     * @var string
     */
    public const FACADE_OMS = 'FACADE_OMS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCreditMemoGiftCardConnectorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoGiftCardConnectorFacade(Container $container)
    {
        $container->set(static::FACADE_CREDIT_MEMO_GIFT_CARD_CONNECTOR, function (Container $container) {
            return new OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorBridge($container->getLocator()->creditMemoGiftCardConnector()->facade());
        });

        return $container;
    }
}
