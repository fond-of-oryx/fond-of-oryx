<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction;

use Codeception\Test\Unit;

class PaymentTotalAmountRestrictionConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new PaymentTotalAmountRestrictionConfig();
    }

    /**
     * @return void
     */
    public function testGetTotalAmountRestrictedPaymentMethodCombinations(): void
    {
        static::assertEquals([], $this->config->getTotalAmountRestrictedPaymentMethodCombinations());
    }
}
