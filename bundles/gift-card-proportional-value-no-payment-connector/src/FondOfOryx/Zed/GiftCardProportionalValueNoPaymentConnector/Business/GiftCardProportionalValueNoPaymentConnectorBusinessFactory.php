<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business;

use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculator;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidator;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig getConfig()
 */
class GiftCardProportionalValueNoPaymentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface
     */
    public function createProportionalGiftCardCalculator(): ProportionalGiftCardCalculatorInterface
    {
        return new ProportionalGiftCardCalculator();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface
     */
    public function createOnlyGiftCardPaymentValidator(): OnlyGiftCardPaymentValidatorInterface
    {
        return new OnlyGiftCardPaymentValidator($this->getConfig());
    }
}
