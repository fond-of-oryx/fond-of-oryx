<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class OrderBudgetWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter
     */
    protected $orderBudgetWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriter = new class (
            $this->orderBudgetFacadeMock,
            $this->entityManagerMock,
            $this->repositoryMock,
            $this->loggerMock,
            $this->transactionHandlerMock
        ) extends OrderBudgetWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade
             * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface $repository
             * @param \Psr\Log\LoggerInterface $logger
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade,
                CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager,
                CompanyBusinessUnitOrderBudgetRepositoryInterface $repository,
                LoggerInterface $logger,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct($orderBudgetFacade, $entityManager, $repository, $logger);

                $this->transactionHandler = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler(): TransactionHandlerInterface
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateForCompanyBusinessUnit(): void
    {
        $idOrderBudget = 1;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn(null);

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('createOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getIdOrderBudget')
            ->willReturn($idOrderBudget);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('setFkOrderBudget')
            ->with($idOrderBudget)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('setOrderBudget')
            ->with($this->orderBudgetTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignOrderBudgetToCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        $this->orderBudgetWriter->createForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateForCompanyBusinessUnitWithExistingOrderBudget(): void
    {
        $idOrderBudget = 1;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn($idOrderBudget);

        $this->orderBudgetFacadeMock->expects(static::never())
            ->method('createOrderBudget');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('setFkOrderBudget');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('setOrderBudget');

        $this->entityManagerMock->expects(static::never())
            ->method('assignOrderBudgetToCompanyBusinessUnit');

        $this->orderBudgetWriter->createForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateMissing(): void
    {
        $idOrderBudget = 1;
        $idCompanyBusinessUnit = 5;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIdsWithoutOrderBudget')
            ->willReturn([$idCompanyBusinessUnit]);

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('createOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getIdOrderBudget')
            ->willReturn($idOrderBudget);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignOrderBudgetToCompanyBusinessUnit')
            ->with(
                static::callback(
                    static function (
                        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
                    ) use (
                        $idCompanyBusinessUnit,
                        $idOrderBudget
                    ) {
                        return $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === $idCompanyBusinessUnit
                            && $companyBusinessUnitTransfer->getFkOrderBudget() === $idOrderBudget;
                    },
                ),
            );

        $this->orderBudgetWriter->createMissing();
    }
}
