<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardProportionalValuePayoneConnectorFacadeTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $isPayonePaymentValidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardCalculator;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factoryMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorBusinessFactory::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->isPayonePaymentValidatorMock =
            $this->getMockBuilder(IsPayonePaymentValidatorInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->proportionalGiftCardCalculator =
            $this->getMockBuilder(ProportionalGiftCardCalculatorInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->facade = new GiftCardProportionalValuePayoneConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCalculateProportionalGiftCardValues(): void
    {
        $collection = new ArrayObject();
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardCalculator')
            ->willReturn($this->proportionalGiftCardCalculator);

        $this->proportionalGiftCardCalculator->expects(static::atLeastOnce())
            ->method('calculate')
            ->willReturn($collection);

        $this->facade->calculateProportionalGiftCardValues($this->spySalesOrderMock, $collection);
    }

    /**
     * @return void
     */
    public function testIsPayonePaymentMethod(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createIsPayonePaymentValidator')
            ->willReturn($this->isPayonePaymentValidatorMock);

        $this->isPayonePaymentValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->willReturn(true);

        $this->facade->isPayonePaymentMethod($this->spySalesOrderMock);
    }
}
