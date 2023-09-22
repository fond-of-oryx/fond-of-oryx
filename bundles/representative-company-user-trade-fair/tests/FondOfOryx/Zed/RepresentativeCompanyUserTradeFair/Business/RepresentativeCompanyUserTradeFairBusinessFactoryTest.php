<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManager;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepository;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairDependencyProvider;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class RepresentativeCompanyUserTradeFairBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairBusinessFactory
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

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->transactionHandlerMock, $this->loggerMock) extends RepresentativeCompanyUserTradeFairBusinessFactory {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandlerMock;

            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $loggerMock;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(TransactionHandlerInterface $transactionHandler, LoggerInterface $logger)
            {
                $this->transactionHandlerMock = $transactionHandler;
                $this->loggerMock = $logger;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler()
            {
                return $this->transactionHandlerMock;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            public function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };

        $this->factory->setContainer($this->containerMock);
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateTradeFairRepresentationManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [RepresentativeCompanyUserTradeFairDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER],
            )
            ->willReturnOnConsecutiveCalls(
                $this->representativeCompanyUserFacadeMock,
            );

        static::assertInstanceOf(
            TradeFairRepresentationManager::class,
            $this->factory
                ->createTradeFairRepresentationManager(),
        );
    }
}
