<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardProportionalValueNoPaymentConnectorFacadeTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\GiftCardProportionalValueNoPaymentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $onlyGiftCardPaymentValidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardCalculator;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\GiftCardProportionalValueNoPaymentConnectorFacade
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
            $this->getMockBuilder(GiftCardProportionalValueNoPaymentConnectorBusinessFactory::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->onlyGiftCardPaymentValidatorMock =
            $this->getMockBuilder(OnlyGiftCardPaymentValidatorInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->proportionalGiftCardCalculator =
            $this->getMockBuilder(ProportionalGiftCardCalculatorInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->facade = new GiftCardProportionalValueNoPaymentConnectorFacade();
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
    public function testIsOnlyGiftCardPaymentMethod(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOnlyGiftCardPaymentValidator')
            ->willReturn($this->onlyGiftCardPaymentValidatorMock);

        $this->onlyGiftCardPaymentValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->willReturn(true);

        $this->facade->isOnlyGiftCardPaymentMethod($this->spySalesOrderMock);
    }
}
