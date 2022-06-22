<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction;

use Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductPaymentRestrictionDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PAYMENT_METHOD = 'PROPEL_QUERY_PAYMENT_METHOD';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addPaymentMethodQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPaymentMethodQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PAYMENT_METHOD] = static function () {
            return SpyPaymentMethodQuery::create();
        };

        return $container;
    }
}
