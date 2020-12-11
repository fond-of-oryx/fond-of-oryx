<?php

namespace FondOfOryx\Zed\ErpOrderApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeBridge;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ErpOrderApiDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\ErpOrderApiDependencyProvider
     */
    protected $erpOrderApiDependencyProvider;

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

        $this->erpOrderFacadeMock = $this->getMockBuilder(ErpOrderFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiDependencyProvider = new ErpOrderApiDependencyProvider();
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
            ->withConsecutive(['erpOrder'], ['api'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['queryContainer'])
            ->willReturnOnConsecutiveCalls(
                $this->erpOrderFacadeMock,
                $this->apiQueryContainerMock
            );

        $container = $this->erpOrderApiDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ErpOrderApiToErpOrderFacadeBridge::class,
            $container[ErpOrderApiDependencyProvider::FACADE_ERP_ORDER]
        );

        static::assertInstanceOf(
            ErpOrderApiToApiQueryContainerBridge::class,
            $container[ErpOrderApiDependencyProvider::QUERY_CONTAINER_API]
        );
    }
}
