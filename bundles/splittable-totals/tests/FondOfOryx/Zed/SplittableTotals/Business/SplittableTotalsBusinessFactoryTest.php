<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig;
use FondOfOryx\Zed\SplittableTotals\SplittableTotalsDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculationFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(SplittableTotalsConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculationFacadeMock = $this->getMockBuilder(SplittableTotalsToCalculationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableTotalsReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableTotalsDependencyProvider::FACADE_CALCULATION],
                [SplittableTotalsDependencyProvider::FACADE_CALCULATION],
                [SplittableTotalsDependencyProvider::PLUGINS_SPLITTED_QUOTE_EXPANDER]
            )->willReturnOnConsecutiveCalls(
                $this->calculationFacadeMock,
                $this->calculationFacadeMock,
                []
            );

        static::assertInstanceOf(
            SplittableTotalsReader::class,
            $this->businessFactory->createSplittableTotalsReader()
        );
    }
}
