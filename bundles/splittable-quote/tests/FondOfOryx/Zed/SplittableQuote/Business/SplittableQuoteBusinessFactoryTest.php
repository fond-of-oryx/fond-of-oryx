<?php

namespace FondOfOryx\Zed\SplittableQuote\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitter;
use FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig;
use FondOfOryx\Zed\SplittableQuote\SplittableQuoteDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableQuoteBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculationFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteBusinessFactory
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

        $this->configMock = $this->getMockBuilder(SplittableQuoteConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculationFacadeMock = $this->getMockBuilder(SplittableQuoteToCalculationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableQuoteBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteSplitter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableQuoteDependencyProvider::FACADE_CALCULATION],
                [SplittableQuoteDependencyProvider::PLUGINS_SPLITTED_QUOTE_EXPANDER]
            )->willReturnOnConsecutiveCalls(
                $this->calculationFacadeMock,
                []
            );

        static::assertInstanceOf(
            QuoteSplitter::class,
            $this->businessFactory->createQuoteSplitter()
        );
    }
}
