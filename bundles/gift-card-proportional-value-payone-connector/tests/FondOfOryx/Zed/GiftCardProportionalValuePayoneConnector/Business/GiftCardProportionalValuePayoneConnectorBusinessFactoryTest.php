<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardProportionalValuePayoneConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $payoneServiceMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $salesFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $isPayonePaymentValidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardCalculator;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->containerMock =
            $this->getMockBuilder(Container::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->salesFacadeMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->payoneServiceMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factory = new GiftCardProportionalValuePayoneConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardCalculator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [GiftCardProportionalValuePayoneConnectorDependencyProvider::SERVICE_PAYONE],
                [GiftCardProportionalValuePayoneConnectorDependencyProvider::FACADE_SALES],
            )->willReturnOnConsecutiveCalls(
                $this->payoneServiceMock,
                $this->salesFacadeMock,
            );

        $this->assertInstanceOf(ProportionalGiftCardCalculatorInterface::class, $this->factory->createProportionalGiftCardCalculator());
    }

    /**
     * @return void
     */
    public function testCreateIsPayonePaymentValidator(): void
    {
        $this->assertInstanceOf(IsPayonePaymentValidatorInterface::class, $this->factory->createIsPayonePaymentValidator());
    }
}
