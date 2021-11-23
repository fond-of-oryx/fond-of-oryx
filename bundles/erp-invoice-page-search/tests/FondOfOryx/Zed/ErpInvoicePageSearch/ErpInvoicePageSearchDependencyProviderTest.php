<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery;
use Spryker\Service\UtilEncoding\UtilEncodingService;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpInvoicePageSearchDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Locator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $locatorMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingService
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider
     */
    protected $erpInvoicePageSearchDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(UtilEncodingService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(EventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchDependencyProvider = new ErpInvoicePageSearchDependencyProvider();
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
            ->withConsecutive(
                ['utilEncoding'],
            )
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('service')
            ->willReturnOnConsecutiveCalls(
                $this->utilEncodingServiceMock,
            );

        $this->assertEquals(
            $this->containerMock,
            $this->erpInvoicePageSearchDependencyProvider->provideBusinessLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpInvoicePageSearchToUtilEncodingServiceBridge::class,
            $this->containerMock[ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING],
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
            ->withConsecutive(
                ['eventBehavior'],
            )
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->eventBehaviorFacadeMock,
            );

        $this->assertEquals(
            $this->containerMock,
            $this->erpInvoicePageSearchDependencyProvider->provideCommunicationLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpInvoicePageSearchToEventBehaviorFacadeBridge::class,
            $this->containerMock[ErpInvoicePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR],
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertEquals(
            $this->containerMock,
            $this->erpInvoicePageSearchDependencyProvider->providePersistenceLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            FooErpInvoiceQuery::class,
            $this->containerMock[ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE],
        );

        $this->assertInstanceOf(
            FooErpInvoicePageSearchQuery::class,
            $this->containerMock[ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE_PAGE_SEARCH],
        );
    }
}
