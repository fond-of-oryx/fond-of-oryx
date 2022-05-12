<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector;

use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\CreditMemoGiftCardConnectorConfig getConfig()
 */
class CreditMemoGiftCardConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_FOO_CREDIT_MEMO = 'QUERY_FOO_CREDIT_MEMO';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCreditMemoQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCreditMemoQuery(Container $container): Container
    {
        $container[static::QUERY_FOO_CREDIT_MEMO] = static function () {
            return new FooCreditMemoQuery();
        };

        return $container;
    }
}
