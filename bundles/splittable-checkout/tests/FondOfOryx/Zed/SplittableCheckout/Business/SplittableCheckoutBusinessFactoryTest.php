<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory
     */
    protected $splittableCheckoutBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $splittableCheckoutToCheckoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $splittableCheckoutToQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     */
    protected $splittableCheckoutToPersistentCartFacadeInterface;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(SplittableCheckoutConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutToCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToQuoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToPersistentCartFacadeMock = $this->getMockBuilder(SplittableCheckoutToPersistentCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutBusinessFactory = new SplittableCheckoutBusinessFactory();
        $this->splittableCheckoutBusinessFactory->setContainer($this->containerMock);
        $this->splittableCheckoutBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutWorkflow(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableCheckoutDependencyProvider::FACADE_CHECKOUT],
                [SplittableCheckoutDependencyProvider::FACADE_QUOTE],
                [SplittableCheckoutDependencyProvider::FACADE_PERSISTENT_CART]
            )
            ->willReturnOnConsecutiveCalls(
                $this->splittableCheckoutToCheckoutFacadeMock,
                $this->splittableCheckoutToQuoteFacadeMock,
                $this->splittableCheckoutToPersistentCartFacadeMock
            );

        $this->assertInstanceOf(
            SplittableCheckoutWorkflowInterface::class,
            $this->splittableCheckoutBusinessFactory->createSplittableCheckoutWorkflow()
        );
    }
}
