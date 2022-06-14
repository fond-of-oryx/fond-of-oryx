<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig;
use Spryker\Zed\Kernel\Container;

class GiftCardProportionalValueNoPaymentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $onlyGiftCardPaymentValidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardCalculator;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\GiftCardProportionalValueNoPaymentConnectorBusinessFactory
     */
    protected $factory;

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

        $this->containerMock =
            $this->getMockBuilder(Container::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factory = new GiftCardProportionalValueNoPaymentConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardCalculator(): void
    {
        $this->assertInstanceOf(ProportionalGiftCardCalculatorInterface::class, $this->factory->createProportionalGiftCardCalculator());
    }
}
