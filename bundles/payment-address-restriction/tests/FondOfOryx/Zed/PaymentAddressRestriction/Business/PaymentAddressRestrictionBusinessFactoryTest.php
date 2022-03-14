<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;

class PaymentAddressRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected $paymentAddressRestrictionConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentAddressRestrictionConfigMock = $this->getMockBuilder(PaymentAddressRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = new PaymentAddressRestrictionBusinessFactory();
        $this->businessFactoryMock->setConfig($this->paymentAddressRestrictionConfigMock);
    }

    /**
     * @return void
     */
    public function testCreatePaymentCountryRestrictionPaymentMethodFilter(): void
    {
        static::assertInstanceOf(
            CountryRestrictionRestrictionPaymentMethodFilter::class,
            $this->businessFactoryMock->createCountryRestrictionPaymentMethodFilter(),
        );
    }
}
