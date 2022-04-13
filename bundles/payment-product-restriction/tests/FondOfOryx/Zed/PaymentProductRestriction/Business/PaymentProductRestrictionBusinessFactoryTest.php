<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig;

class PaymentProductRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentProductRestrictionBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(PaymentProductRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new PaymentProductRestrictionBusinessFactory();
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreatePaymentProductRestrictionPaymentMethodFilter(): void
    {
        static::assertInstanceOf(
            PaymentProductRestrictionPaymentMethodFilter::class,
            $this->businessFactory->createPaymentProductRestrictionPaymentMethodFilter(),
        );
    }
}
