<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculator;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface;
use FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepository;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepository
     */
    protected $shipmentTableRateRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig
     */
    protected $shipmentTableRateConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected $countryFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilMathFormulaServiceMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $priceToPayFilterPluginMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory
     */
    protected $shipmentTableRateBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateRepositoryMock = $this->getMockBuilder(ShipmentTableRateRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateConfigMock = $this->getMockBuilder(ShipmentTableRateConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(ShipmentTableRateToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryFacadeMock = $this->getMockBuilder(ShipmentTableRateToCountryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilMathFormulaServiceMock = $this->getMockBuilder(ShipmentTableRateToUtilMathFormulaServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceToPayFilterPluginMock = $this->getMockBuilder(PriceToPayFilterPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateBusinessFactory = new ShipmentTableRateBusinessFactory();
        $this->shipmentTableRateBusinessFactory->setRepository($this->shipmentTableRateRepositoryMock);
        $this->shipmentTableRateBusinessFactory->setContainer($this->containerMock);
        $this->shipmentTableRateBusinessFactory->setConfig($this->shipmentTableRateConfigMock);
    }

    /**
     * @return void
     */
    public function testCreatePriceCalculator(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ShipmentTableRateDependencyProvider::FACADE_COUNTRY:
                        return $self->countryFacadeMock;
                    case ShipmentTableRateDependencyProvider::FACADE_STORE:
                        return $self->storeFacadeMock;
                    case ShipmentTableRateDependencyProvider::PLUGIN_PRICE_TO_PAY_FILTER:
                        return $self->priceToPayFilterPluginMock;
                    case ShipmentTableRateDependencyProvider::SERVICE_UTIL_MATH_FORMULA:
                        return $self->utilMathFormulaServiceMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            PriceCalculator::class,
            $this->shipmentTableRateBusinessFactory->createPriceCalculator(),
        );
    }
}
