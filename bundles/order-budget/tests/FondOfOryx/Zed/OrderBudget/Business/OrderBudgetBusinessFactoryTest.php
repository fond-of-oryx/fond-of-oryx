<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetter;
use FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\OrderBudgetDependencyProvider;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManager;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepository;
use Spryker\Zed\Kernel\Container;

class OrderBudgetBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilDateTimeServiceMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(OrderBudgetConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(OrderBudgetEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(OrderBudgetRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilDateTimeServiceMock = $this->getMockBuilder(OrderBudgetToUtilDateTimeServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new OrderBudgetBusinessFactory();
        $this->businessFactory->setConfig($this->configMock);
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetResetter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(OrderBudgetDependencyProvider::SERVICE_UTIL_DATETIME)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(OrderBudgetDependencyProvider::SERVICE_UTIL_DATETIME)
            ->willReturn($this->utilDateTimeServiceMock);

        static::assertInstanceOf(
            OrderBudgetResetter::class,
            $this->businessFactory->createOrderBudgetResetter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetWriter(): void
    {
        static::assertInstanceOf(
            OrderBudgetWriter::class,
            $this->businessFactory->createOrderBudgetWriter(),
        );
    }
}
