<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

use DateTime;
use FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface;
use FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
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
     * @var \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface $orderBudgetReader
     * @param \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper
     * @param \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService
     * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig $config
     */
    public function __construct(
        OrderBudgetReaderInterface $orderBudgetReader,
        OrderBudgetHistoryMapperInterface $orderBudgetHistoryMapper,
        OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService,
        OrderBudgetEntityManagerInterface $entityManager,
        OrderBudgetConfig $config
    ) {
        $this->orderBudgetReader = $orderBudgetReader;
        $this->orderBudgetHistoryMapper = $orderBudgetHistoryMapper;
        $this->utilDateTimeService = $utilDateTimeService;
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    /**
     * @param array<int> $orderBudgetIds
     *
     * @return void
     */
    public function resetMultiple(array $orderBudgetIds = []): void
    {
        $self = $this;

        $this->getTransactionHandler()->handleTransaction(static function () use ($self, $orderBudgetIds) {
            if (count($orderBudgetIds) === 0) {
                $self->executeResetMultiple($self->orderBudgetReader->getAll());

                return;
            }

            $self->executeResetMultiple($self->orderBudgetReader->getByIds($orderBudgetIds));
        });
    }

    /**
     * @param array<\Generated\Shared\Transfer\OrderBudgetTransfer> $orderBudgetTransfers
     *
     * @return void
     */
    protected function executeResetMultiple(array $orderBudgetTransfers): void
    {
        foreach ($orderBudgetTransfers as $orderBudgetTransfer) {
            $now = $this->utilDateTimeService->formatDate(new DateTime());

            $orderBudgetHistoryTransfer = $this->orderBudgetHistoryMapper->fromOrderBudget($orderBudgetTransfer)
                ->setValidTo($now);

            $this->entityManager->createOrderBudgetHistory($orderBudgetHistoryTransfer);

            if ($orderBudgetTransfer->getNextInitialBudget() === null) {
                $orderBudgetTransfer->setNextInitialBudget($this->config->getInitialBudget());
            }

            $nextInitialBudget = $orderBudgetTransfer->getNextInitialBudget();

            $orderBudgetTransfer->setInitialBudget($nextInitialBudget)
                ->setBudget($nextInitialBudget);

            $this->entityManager->updateOrderBudget($orderBudgetTransfer);
        }
    }
}
