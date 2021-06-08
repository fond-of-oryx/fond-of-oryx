<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessor;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
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
                [SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE],
                [SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT]
            )
            ->willReturnOnConsecutiveCalls(
                $this->quoteFacadeMock,
                $this->splittableCheckoutFacadeMock
            );

        static::assertInstanceOf(
            SplittableCheckoutProcessor::class,
            $this->businessFactory->createPlaceOrderProcessor()
        );
    }
}
