<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Cleanupper;

use DateTime;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class OrderBudgetHistoryCleanupper implements OrderBudgetHistoryCleanupperInterface
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
    public function removeOldHistoryEntries(): void
    {
        $self = $this;

        $this->getTransactionHandler()->handleTransaction(static function () use ($self) {
            $self->executeCleanup();
        });
    }

    /**
     * @return void
     */
    protected function executeCleanup(): void
    {
        $maxDate = date('Y-m-d', strtotime(sprintf('- %s days', $this->config->getHistoryRetentionTime())));
        $test = new DateTime($maxDate);
        $this->entityManager->deleteOrderBudgetHistoryEntriesOlderThan($test);
    }
}
