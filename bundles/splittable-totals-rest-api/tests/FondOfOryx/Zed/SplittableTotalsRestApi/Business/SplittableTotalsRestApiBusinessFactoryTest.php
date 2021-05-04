<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\SplittableTotalsRestApiDependencyProvider;
use FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected $quoteExpanderPluginMocks;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderPluginMocks = [
            $this->getMockBuilder(QuoteExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock(),
        ];

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiToSplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsRestApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
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
                [SplittableTotalsRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER],
                [SplittableTotalsRestApiDependencyProvider::FACADE_QUOTE],
                [SplittableTotalsRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS]
            )
            ->willReturnOnConsecutiveCalls(
                $this->quoteExpanderPluginMocks,
                $this->quoteFacadeMock,
                $this->splittableTotalsFacadeFacadeMock
            );

        static::assertInstanceOf(
            SplittableTotalsReader::class,
            $this->businessFactory->createSplittableTotalsReader()
        );
    }
}
