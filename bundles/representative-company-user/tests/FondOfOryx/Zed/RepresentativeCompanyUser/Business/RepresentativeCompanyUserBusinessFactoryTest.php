<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReader;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunnerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepository;
use FondOfOryx\Zed\RepresentativeCompanyUser\RepresentativeCompanyUserDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class RepresentativeCompanyUserBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->transactionHandlerMock) extends RepresentativeCompanyUserBusinessFactory {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandlerMock;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(TransactionHandlerInterface $transactionHandler)
            {
                $this->transactionHandlerMock = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler()
            {
                return $this->transactionHandlerMock;
            }
        };

        $this->factory->setContainer($this->containerMock);
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateTaskRunner(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserDependencyProvider::PLUGINS_TASKS)
            ->willReturn([]);

        static::assertInstanceOf(
            TaskRunnerInterface::class,
            $this->factory
                ->createTaskRunner(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRepresentativeCompanyUserReader(): void
    {
        static::assertInstanceOf(
            RepresentativeCompanyUserReader::class,
            $this->factory
                ->createRepresentativeCompanyUserReader(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRepresentationManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([RepresentativeCompanyUserDependencyProvider::FACADE_EVENT])
            ->willReturnOnConsecutiveCalls(
                $this->eventFacadeMock,
            );

        static::assertInstanceOf(
            RepresentationManager::class,
            $this->factory
                ->createRepresentationManager(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserDependencyProvider::FACADE_COMPANY_USER)
            ->willReturn($this->companyUserFacadeMock);

        static::assertInstanceOf(
            CompanyUserManager::class,
            $this->factory
                ->createCompanyUserManager(),
        );
    }
}
