<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter\SalesOrderExporter;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Trigger\SalesOrderExportTrigger;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderDependencyProvider;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainer;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepository;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $omsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(JellyfishSalesOrderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(JellyfishSalesOrderQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(JellyfishSalesOrderRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(JellyfishSalesOrderToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsFacadeMock = $this->getMockBuilder(JellyfishSalesOrderToOmsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(JellyfishSalesOrderToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new JellyfishSalesOrderBusinessFactory();
        $this->businessFactory->setConfig($this->configMock);
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setQueryContainer($this->queryContainerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateSalesOrderExporter(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP:
                        return [];
                    case JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP:
                        return [];
                    case JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP:
                        return [];
                    case JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_POST_MAP:
                        return [];
                    case JellyfishSalesOrderDependencyProvider::SERVICE_UTIL_ENCODING:
                        return $self->utilEncodingServiceMock;
                    case JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            SalesOrderExporter::class,
            $this->businessFactory->createSalesOrderExporter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSalesOrderExportTrigger(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderDependencyProvider::FACADE_OMS:
                        return $self->omsFacadeMock;
                    case JellyfishSalesOrderDependencyProvider::FACADE_STORE:
                        return $self->storeFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            SalesOrderExportTrigger::class,
            $this->businessFactory->createSalesOrderExportTrigger(),
        );
    }
}
