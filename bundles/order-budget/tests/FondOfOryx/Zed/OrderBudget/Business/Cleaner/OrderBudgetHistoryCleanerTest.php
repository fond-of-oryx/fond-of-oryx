<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\OrderBudget\Business\Cleaner\OrderBudgetHistoryCleaner;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class OrderBudgetHistoryCleanerTest extends Unit
{
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
     * @var \FondOfOryx\Zed\OrderBudget\Business\Cleaner\OrderBudgetHistoryCleaner
     */
    protected $cleanupper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(OrderBudgetEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OrderBudgetConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cleanupper = new class (
            $this->entityManagerMock,
            $this->configMock,
            $this->transactionHandlerMock
        ) extends OrderBudgetHistoryCleaner {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig $config
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                OrderBudgetEntityManagerInterface $entityManager,
                OrderBudgetConfig $config,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
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
    public function testClean(): void
    {
        $date = date('Y-m-d', strtotime('- 1 days'));

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteOrderBudgetHistoryEntriesOlderThan')
            ->willReturnCallback(static function (DateTime $dateTime) use ($date) {
                static::assertEquals($date, $dateTime->format('Y-m-d'));
            });

        $this->configMock->expects(static::atLeastOnce())
            ->method('getHistoryRetentionTime')
            ->willReturn(1);

        $this->cleanupper->clean();
    }
}
