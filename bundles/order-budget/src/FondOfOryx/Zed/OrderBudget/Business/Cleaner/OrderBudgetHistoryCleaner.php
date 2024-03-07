<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Cleaner;

use DateInterval;
use DateTime;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class OrderBudgetHistoryCleaner implements OrderBudgetHistoryCleanerInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig $config
     */
    public function __construct(
        OrderBudgetEntityManagerInterface $entityManager,
        OrderBudgetConfig $config
    ) {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    /**
     * @return void
     */
    public function clean(): void
    {
        $self = $this;

        $this->getTransactionHandler()->handleTransaction(static function () use ($self) {
            $self->executeClean();
        });
    }

    /**
     * @return void
     */
    protected function executeClean(): void
    {
        $oldestDate = (new DateTime())->sub(new DateInterval(sprintf('P%sD', $this->config->getHistoryRetentionTime())));
        $this->entityManager->deleteOrderBudgetHistoryEntriesOlderThan($oldestDate);
    }
}
