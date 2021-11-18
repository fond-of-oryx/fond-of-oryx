<?php

namespace FondOfOryx\Zed\ErpInvoiceApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeBridge;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpInvoiceApiDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiDependencyProvider
     */
    protected $erpInvoiceApiDependencyProvider;

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

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiDependencyProvider = new ErpInvoiceApiDependencyProvider();
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
            ->withConsecutive(['erpInvoice'], ['api'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['queryContainer'])
            ->willReturnOnConsecutiveCalls(
                $this->erpInvoiceFacadeMock,
                $this->apiQueryContainerMock,
            );

        $container = $this->erpInvoiceApiDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ErpInvoiceApiToErpInvoiceFacadeBridge::class,
            $container[ErpInvoiceApiDependencyProvider::FACADE_ERP_INVOICE],
        );

        static::assertInstanceOf(
            ErpInvoiceApiToApiQueryContainerBridge::class,
            $container[ErpInvoiceApiDependencyProvider::QUERY_CONTAINER_API],
        );
    }
}
