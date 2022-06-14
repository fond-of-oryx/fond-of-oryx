<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator;

use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\ObjectCollection;

class IsPayonePaymentValidator implements IsPayonePaymentValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig $config
     */
    public function __construct(GiftCardProportionalValuePayoneConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return bool
     */
    public function validate(SpySalesOrder $orderEntity): bool
    {
        $payoneMethods = $orderEntity->getSpyPaymentPayones();

        if (count($payoneMethods) === 0) {
            return false;
        }

        if ($this->isInListedPayonePaymentMethod($payoneMethods) === false && $this->config->getListeningToAllPayonePaymentMethods() === false) {
            return false;
        }

        return true;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Payone\Persistence\SpyPaymentPayone> $payoneMethods
     *
     * @return bool
     */
    protected function isInListedPayonePaymentMethod(ObjectCollection $payoneMethods): bool
    {
        foreach ($payoneMethods as $payoneMethod) {
            if (in_array($payoneMethod->getPaymentMethod(), $this->config->getPayonePaymentMethods(), true)) {
                return true;
            }
        }

        return false;
    }
}
