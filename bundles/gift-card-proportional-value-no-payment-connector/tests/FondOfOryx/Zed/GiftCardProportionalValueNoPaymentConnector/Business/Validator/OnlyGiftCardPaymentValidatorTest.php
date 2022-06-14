<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Shared\Nopayment\NopaymentConfig as NopaymentNopaymentConfig;

class OnlyGiftCardPaymentValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectCollectionMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesPaymentMethodTypeMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPayment|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesPaymentMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock =
            $this->getMockBuilder(GiftCardProportionalValueNoPaymentConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesPaymentMock =
            $this->getMockBuilder(SpySalesPayment::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->objectCollectionMock =
            $this->getMockBuilder(ObjectCollection::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesPaymentMethodTypeMock =
            $this->getMockBuilder(SpySalesPaymentMethodType::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->validator = new OnlyGiftCardPaymentValidator($this->configMock);
    }

    /**
     * @return void
     */
    public function testValidateTrue(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn([$this->spySalesPaymentMock]);

        $this->spySalesPaymentMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesPaymentMethodTypeMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn(NopaymentNopaymentConfig::PAYMENT_PROVIDER_NAME);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getNoPaymentMethods')->willReturn([
                NopaymentNopaymentConfig::PAYMENT_PROVIDER_NAME,
            ]);

        $this->assertTrue($this->validator->validate($this->spySalesOrderMock));
    }

    /**
     * @return void
     */
    public function testValidateFalseMethodTypeNoMatch(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn([$this->spySalesPaymentMock]);

        $this->spySalesPaymentMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesPaymentMethodTypeMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn(NopaymentNopaymentConfig::PAYMENT_PROVIDER_NAME);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getNoPaymentMethods')->willReturn([
                'credit card',
            ]);

        $this->assertFalse($this->validator->validate($this->spySalesOrderMock));
    }

    /**
     * @return void
     */
    public function testValidateFalse(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(0);

        $this->configMock->expects(static::never())
            ->method('getNoPaymentMethods');

        $this->assertFalse($this->validator->validate($this->spySalesOrderMock));
    }
}
