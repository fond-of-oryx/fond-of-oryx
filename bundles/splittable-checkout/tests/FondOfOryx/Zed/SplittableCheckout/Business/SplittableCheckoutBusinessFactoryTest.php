<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $splittableCheckoutToCheckoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $splittableCheckoutToQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface
     */
    protected $splittableCheckoutToSplittableQuoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory
     */
    protected $splittableCheckoutBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutToCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToQuoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToSplittableQuoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToSplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutBusinessFactory = new SplittableCheckoutBusinessFactory();
        $this->splittableCheckoutBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutWorkflow(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableCheckoutDependencyProvider::FACADE_CHECKOUT],
                [SplittableCheckoutDependencyProvider::FACADE_SPLITTABLE_QUOTE],
                [SplittableCheckoutDependencyProvider::FACADE_QUOTE],
            )
            ->willReturnOnConsecutiveCalls(
                $this->splittableCheckoutToCheckoutFacadeMock,
                $this->splittableCheckoutToSplittableQuoteFacadeMock,
                $this->splittableCheckoutToQuoteFacadeMock
            );

        static::assertInstanceOf(
            SplittableCheckoutWorkflow::class,
            $this->splittableCheckoutBusinessFactory->createSplittableCheckoutWorkflow()
        );
    }
}
