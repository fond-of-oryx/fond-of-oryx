<?php

namespace FondOfOryx\Zed\PaymentProductRestriction;

use Codeception\Test\Unit;

class PaymentProductRestrictionConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new PaymentProductRestrictionConfig();
    }

    /**
     * @return void
     */
    public function testGetProductAttributeBlacklistedPaymentMethods(): void
    {
        static::assertEquals('', $this->config->getProductAttributeBlacklistedPaymentMethods());
    }

    /**
     * @return void
     */
    public function testGetMappingBlacklistedPaymentMethods(): void
    {
        static::assertEquals([], $this->config->getMappingBlacklistedPaymentMethods());
    }
}
