<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpander;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManager;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepository;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $payoneServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $salesFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->payoneServiceMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueCalculator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::SERVICE_PAYONE],
                [JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_SALES],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::SERVICE_PAYONE],
                [JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_SALES],
            )
            ->willReturnOnConsecutiveCalls($this->payoneServiceMock, $this->salesFacadeMock);

        static::assertInstanceOf(
            ProportionalGiftCardAmountCalculator::class,
            $this->factory->createProportionalGiftCardValueCalculator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueManager(): void
    {
        static::assertInstanceOf(
            ProportionalGiftCardValueManager::class,
            $this->factory->createProportionalGiftCardValueManager(),
        );
    }

    /**
     * @return void
     */
    public function testCreateOrderItemsExpander(): void
    {
        static::assertInstanceOf(
            OrderItemsExpander::class,
            $this->factory->createOrderItemsExpander(),
        );
    }
}
