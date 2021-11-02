<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery;
use Spryker\Service\UtilEncoding\UtilEncodingService;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpOrderPageSearchDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider
     */
    protected $erpOrderPageSearchDependencyProvider;

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

        $this->erpOrderPageSearchDependencyProvider = new ErpOrderPageSearchDependencyProvider();
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
            $this->erpOrderPageSearchDependencyProvider->provideBusinessLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpOrderPageSearchToUtilEncodingServiceBridge::class,
            $this->containerMock[ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING],
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
            $this->erpOrderPageSearchDependencyProvider->provideCommunicationLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpOrderPageSearchToEventBehaviorFacadeBridge::class,
            $this->containerMock[ErpOrderPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR],
        );
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertEquals(
            $this->containerMock,
            $this->erpOrderPageSearchDependencyProvider->providePersistenceLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpOrderQuery::class,
            $this->containerMock[ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER],
        );

        $this->assertInstanceOf(
            FooErpOrderPageSearchQuery::class,
            $this->containerMock[ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER_PAGE_SEARCH],
        );
    }
}
