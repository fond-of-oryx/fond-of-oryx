<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Shared\OrderBudget\OrderBudgetConstants;
use FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface;
use FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class OrderBudgetResetterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetReaderMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetHistoryMapperMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilDateTimeServiceMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var array<\Generated\Shared\Transfer\OrderBudgetTransfer>|array<\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $orderBudgetTransferMocks;

    /**
     * @var array<\Generated\Shared\Transfer\OrderBudgetHistoryTransfer>|array<\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $orderBudgetHistoryTransferMocks;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetter
     */
    protected $orderBudgetResetter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetReaderMock = $this->getMockBuilder(OrderBudgetReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetHistoryMapperMock = $this->getMockBuilder(OrderBudgetHistoryMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilDateTimeServiceMock = $this->getMockBuilder(OrderBudgetToUtilDateTimeServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(OrderBudgetEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OrderBudgetConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMocks = [
            $this->getMockBuilder(OrderBudgetTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->orderBudgetHistoryTransferMocks = [
            $this->getMockBuilder(OrderBudgetHistoryTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->orderBudgetResetter = new class (
            $this->orderBudgetReaderMock,
            $this->orderBudgetHistoryMapperMock,
            $this->utilDateTimeServiceMock,
            $this->entityManagerMock,
            $this->configMock,
            $this->transactionHandlerMock
        ) extends OrderBudgetResetter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface $orderBudgetReader
             * @param \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper
             * @param \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService
             * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig $config
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                OrderBudgetReaderInterface $orderBudgetReader,
                OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper,
                OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService,
                OrderBudgetEntityManagerInterface $entityManager,
                OrderBudgetConfig $config,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
                    $orderBudgetReader,
                    $orderBudgetHistoryMapper,
                    $utilDateTimeService,
                    $entityManager,
                    $config,
                );

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
    public function testResetAll(): void
    {
        $now = (new DateTime())->format('Y-m-d');

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getInitialBudget')
            ->willReturn(OrderBudgetConstants::INITIAL_BUDGET_DEFAULT);

        $this->orderBudgetReaderMock->expects(static::atLeastOnce())
            ->method('getAll')
            ->willReturn($this->orderBudgetTransferMocks);

        $this->utilDateTimeServiceMock->expects(static::atLeastOnce())
            ->method('formatDate')
            ->willReturn($now);

        $this->orderBudgetHistoryMapperMock->expects(static::atLeastOnce())
            ->method('fromOrderBudget')
            ->with($this->orderBudgetTransferMocks[0])
            ->willReturn($this->orderBudgetHistoryTransferMocks[0]);

        $this->orderBudgetHistoryTransferMocks[0]->expects(static::atLeastOnce())
            ->method('setValidTo')
            ->with($now)
            ->willReturn($this->orderBudgetHistoryTransferMocks[0]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetHistory')
            ->with($this->orderBudgetHistoryTransferMocks[0]);

        $this->orderBudgetTransferMocks[0]->expects(static::atLeastOnce())
            ->method('setBudget')
            ->with(OrderBudgetConstants::INITIAL_BUDGET_DEFAULT)
            ->willReturn($this->orderBudgetTransferMocks[0]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateOrderBudget')
            ->with($this->orderBudgetTransferMocks[0]);

        $this->orderBudgetResetter->resetAll();
    }
}
