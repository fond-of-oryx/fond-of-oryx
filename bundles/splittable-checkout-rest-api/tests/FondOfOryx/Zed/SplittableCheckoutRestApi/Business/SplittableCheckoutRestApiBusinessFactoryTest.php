<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessor;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory
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

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableCheckoutRestApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreatePlaceOrderProcessor(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER],
                [SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE],
                [SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT]
            )
            ->willReturnOnConsecutiveCalls(
                [],
                $this->quoteFacadeMock,
                $this->splittableCheckoutFacadeMock
            );

        static::assertInstanceOf(
            PlaceOrderProcessor::class,
            $this->businessFactory->createPlaceOrderProcessor()
        );
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
                [SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER],
                [SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE],
                [SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS]
            )
            ->willReturnOnConsecutiveCalls(
                [],
                $this->quoteFacadeMock,
                $this->splittableTotalsFacadeMock
            );

        static::assertInstanceOf(
            SplittableTotalsReader::class,
            $this->businessFactory->createSplittableTotalsReader()
        );
    }
}
