<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction;

use Codeception\Test\Unit;

class ProductPaymentRestrictionConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new ProductPaymentRestrictionConfig();
    }

    /**
     * @return void
     */
    public function testGetProductAttributeBlacklistedPaymentMethods(): void
    {
        static::assertEquals(
            'blacklisted_payment_methods',
            $this->config->getProductAttributeBlacklistedPaymentMethods(),
        );
    }
}
