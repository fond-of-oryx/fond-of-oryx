<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction;

use Codeception\Test\Unit;

class PaymentAddressRestrictionConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected $paymentAddressRestrictionConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentAddressRestrictionConfig = new PaymentAddressRestrictionConfig();
    }

    /**
     * @return void
     */
    public function testgetBlackListedPaymentCountryCombinations(): void
    {
        static::assertEquals([], $this->paymentAddressRestrictionConfig->getBlackListedPaymentCountryCombinations());
    }
}
