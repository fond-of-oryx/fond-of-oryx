<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig;

class ProductPaymentRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductPaymentRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ProductPaymentRestrictionBusinessFactory();
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateProductPaymentRestrictionPaymentMethodFilter(): void
    {
        static::assertInstanceOf(
            ProductPaymentRestrictionPaymentMethodFilter::class,
            $this->businessFactory->createProductPaymentRestrictionPaymentMethodFilter(),
        );
    }
}
