<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

use DateTime;
use FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface;
use FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class OrderBudgetResetter implements OrderBudgetResetterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface
     */
    protected $orderBudgetReader;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface
     */
    protected $orderBudgetHistoryMapper;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface
     */
    protected $utilDateTimeService;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface $orderBudgetReader
     * @param \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper
     * @param \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService
     * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface $entityManager
     */
    public function __construct(
        OrderBudgetReaderInterface $orderBudgetReader,
        OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper,
        OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService,
        OrderBudgetEntityManagerInterface $entityManager
    ) {
        $this->orderBudgetReader = $orderBudgetReader;
        $this->orderBudgetHistoryMapper = $orderBudgetHistoryMapper;
        $this->utilDateTimeService = $utilDateTimeService;
        $this->entityManager = $entityManager;
    }

    /**
     * @return void
     */
    public function resetAll(): void
    {
        $self = $this;

        $this->getTransactionHandler()->handleTransaction(static function () use ($self) {
            $self->executeResetAllTransaction();
        });
    }

    /**
     * @return void
     */
    protected function executeResetAllTransaction(): void
    {
        $orderBudgetTransfers = $this->orderBudgetReader->getAll();

        foreach ($orderBudgetTransfers as $orderBudgetTransfer) {
            $now = $this->utilDateTimeService->formatDate(new DateTime());

            $orderBudgetHistoryTransfer = $this->orderBudgetHistoryMapper->fromOrderBudget($orderBudgetTransfer)
                ->setValidTo($now);

            $this->entityManager->createOrderBudgetHistory($orderBudgetHistoryTransfer);

            $orderBudgetTransfer->setBudget($orderBudgetTransfer->getInitialBudget());

            $this->entityManager->updateOrderBudget($orderBudgetTransfer);
        }
    }
}
