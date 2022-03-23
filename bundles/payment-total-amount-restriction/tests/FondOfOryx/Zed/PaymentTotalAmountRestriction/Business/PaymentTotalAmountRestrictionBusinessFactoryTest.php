<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilterInterface;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig;

class PaymentTotalAmountRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(PaymentTotalAmountRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new PaymentTotalAmountRestrictionBusinessFactory();
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreatePaymentTotalAmountRestrictionPaymentMethodFilter(): void
    {
        static::assertInstanceOf(
            PaymentTotalAmountRestrictionPaymentMethodFilterInterface::class,
            $this->businessFactory->createPaymentTotalAmountRestrictionPaymentMethodFilter(),
        );
    }
}
