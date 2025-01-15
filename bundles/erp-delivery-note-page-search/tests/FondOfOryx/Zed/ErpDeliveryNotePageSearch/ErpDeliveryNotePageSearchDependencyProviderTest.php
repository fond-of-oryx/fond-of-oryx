<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery;
use Spryker\Service\UtilEncoding\UtilEncodingService;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpDeliveryNotePageSearchDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider
     */
    protected $erpDeliveryNotePageSearchDependencyProvider;

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

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

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

        $this->erpDeliveryNotePageSearchDependencyProvider = new ErpDeliveryNotePageSearchDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'utilEncoding':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('service')
            ->willReturnOnConsecutiveCalls(
                $this->utilEncodingServiceMock,
            );

        $this->assertEquals(
            $this->containerMock,
            $this->erpDeliveryNotePageSearchDependencyProvider->provideBusinessLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToUtilEncodingServiceBridge::class,
            $this->containerMock[ErpDeliveryNotePageSearchDependencyProvider::SERVICE_UTIL_ENCODING],
        );
    }

    /**
     * @return void
     */
    public function testProvideCommunicationLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'eventBehavior':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->eventBehaviorFacadeMock,
            );

        $this->assertEquals(
            $this->containerMock,
            $this->erpDeliveryNotePageSearchDependencyProvider->provideCommunicationLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge::class,
            $this->containerMock[ErpDeliveryNotePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR],
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertEquals(
            $this->containerMock,
            $this->erpDeliveryNotePageSearchDependencyProvider->providePersistenceLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            FooErpDeliveryNoteQuery::class,
            $this->containerMock[ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE],
        );

        $this->assertInstanceOf(
            FooErpDeliveryNotePageSearchQuery::class,
            $this->containerMock[ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH],
        );
    }
}
