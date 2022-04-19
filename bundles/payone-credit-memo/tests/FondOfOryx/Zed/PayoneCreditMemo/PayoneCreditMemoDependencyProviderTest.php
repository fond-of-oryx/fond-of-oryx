<?php

namespace FondOfOryx\Zed\PayoneCreditMemo;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacade;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToOmsInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Oms\Business\OmsFacade;
use Spryker\Zed\Refund\Business\RefundFacade;
use Spryker\Zed\Sales\Business\SalesFacade;
use SprykerEco\Zed\Payone\Business\PayoneFacade;

class PayoneCreditMemoDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Refund\Business\RefundFacade
     */
    protected $refundFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacade
     */
    protected $creditMemoFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\Payone\Business\PayoneFacade
     */
    protected $payoneFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Sales\Business\SalesFacade
     */
    protected $salesFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\OmsFacade
     */
    protected $omsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet', 'has', 'offsetExists'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->refundFacadeMock = $this->getMockBuilder(RefundFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoFacadeMock = $this->getMockBuilder(CreditMemoFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->payoneFacadeMock = $this->getMockBuilder(PayoneFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeMock = $this->getMockBuilder(SalesFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsFacadeMock = $this->getMockBuilder(OmsFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new PayoneCreditMemoDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['refund'], ['creditMemo'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->refundFacadeMock,
                $this->creditMemoFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            PayoneCreditMemoToRefundInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_REFUND],
        );
        static::assertInstanceOf(
            PayoneCreditMemoToCreditMemoInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_CREDIT_MEMO],
        );
    }

    /**
     * @return void
     */
    public function testProvideCommunicationLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['creditMemo'], ['refund'], ['payone'], ['sales'], ['oms'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'], ['facade'], ['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->creditMemoFacadeMock,
                $this->refundFacadeMock,
                $this->payoneFacadeMock,
                $this->salesFacadeMock,
                $this->omsFacadeMock,
            );

        $container = $this->dependencyProvider->provideCommunicationLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            PayoneCreditMemoToCreditMemoInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_CREDIT_MEMO],
        );
        static::assertInstanceOf(
            PayoneCreditMemoToRefundInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_REFUND],
        );
        static::assertInstanceOf(
            PayoneCreditMemoToPayoneInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_PAYONE],
        );
        static::assertInstanceOf(
            PayoneCreditMemoToSalesInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_SALES],
        );
        static::assertInstanceOf(
            PayoneCreditMemoToOmsInterface::class,
            $container[PayoneCreditMemoDependencyProvider::FACADE_OMS],
        );
    }
}
