<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class OrderBudgetCompanyBusinessUnitConnectorDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\OrderBudgetCompanyBusinessUnitConnectorDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @Override
     *
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

        $this->orderBudgetFacadeMock = $this->getMockBuilder(OrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new OrderBudgetCompanyBusinessUnitConnectorDependencyProvider();
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
            ->with('orderBudget')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->orderBudgetFacadeMock);

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface::class,
            $container[OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::FACADE_ORDER_BUDGET]
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->dependencyProvider->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            SpyCompanyBusinessUnitQuery::class,
            $container[OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::QUERY_COMPANY_BUSINESS_UNIT]
        );
    }
}
