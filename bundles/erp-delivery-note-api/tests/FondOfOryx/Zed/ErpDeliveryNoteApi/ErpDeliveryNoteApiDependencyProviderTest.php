<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeBridge;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Business\ApiFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpDeliveryNoteApiDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiDependencyProvider
     */
    protected $erpDeliveryNoteApiDependencyProvider;

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

        $this->erpDeliveryNoteFacadeMock = $this->getMockBuilder(ErpDeliveryNoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiDependencyProvider = new ErpDeliveryNoteApiDependencyProvider();
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
            ->withConsecutive(['erpDeliveryNote'], ['api'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->erpDeliveryNoteFacadeMock,
                $this->apiFacadeMock,
            );

        $container = $this->erpDeliveryNoteApiDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridge::class,
            $container[ErpDeliveryNoteApiDependencyProvider::FACADE_ERP_DELIVERY_NOTE],
        );

        static::assertInstanceOf(
            ErpDeliveryNoteApiToApiFacadeBridge::class,
            $container[ErpDeliveryNoteApiDependencyProvider::FACADE_API],
        );
    }
}
