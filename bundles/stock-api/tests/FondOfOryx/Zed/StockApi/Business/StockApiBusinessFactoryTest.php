<?php

namespace FondOfOryx\Zed\StockApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\Model\StockApi;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface;
use FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerBridge;
use FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer;
use FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface;
use FondOfOryx\Zed\StockApi\StockApiConfig;
use FondOfOryx\Zed\StockApi\StockApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class StockApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\AbstractBundleConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryBuilderContainerMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiBusinessFactory
     */
    protected $stockBusinessFactory;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockFacadeMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiFacadeMock = $this->getMockBuilder(StockApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(StockApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(StockApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryBuilderContainerMock = $this->getMockBuilder(StockApiToApiQueryBuilderQueryContainerBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockFacadeMock = $this->getMockBuilder(StockApiToStockInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockBusinessFactory = new class ($this->configMock, $this->containerMock, $this->queryContainerMock) extends StockApiBusinessFactory {
            /**
             * @var \FondOfOryx\Zed\StockApi\StockApiConfig
             */
            protected $configMock;

            /**
             * @var \Spryker\Zed\Kernel\Container
             */
            protected $containerMock;

            /**
             * @var \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface
             */
            protected $queryContainerMock;

            /**
             * @param \FondOfOryx\Zed\StockApi\StockApiConfig $config
             * @param \Spryker\Zed\Kernel\Container $container
             * @param \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface $queryContainer
             */
            public function __construct(StockApiConfig $config, Container $container, StockApiQueryContainerInterface $queryContainer)
            {
                $this->configMock = $config;
                $this->containerMock = $container;
                $this->queryContainerMock = $queryContainer;
            }

            /**
             * @return \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            public function getConfig()
            {
                return $this->configMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Container
             */
            protected function getContainer(): Container
            {
                return $this->containerMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer
             */
            protected function getQueryContainer()
            {
                return $this->queryContainerMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateStockApi()
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [StockApiDependencyProvider::FACADE_STOCK],
                [StockApiDependencyProvider::FACADE_API],
                [StockApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [StockApiDependencyProvider::FACADE_API],
            )->willReturnOnConsecutiveCalls(
                $this->stockFacadeMock,
                $this->apiFacadeMock,
                $this->queryBuilderContainerMock,
                $this->queryContainerMock,
            );

        $this->assertInstanceOf(StockApi::class, $this->stockBusinessFactory->createStockApi());
    }
}
