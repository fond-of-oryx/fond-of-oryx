<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Writer;

use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetWriter implements OrderBudgetWriterInterface
{
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
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function create(?int $budget = null): OrderBudgetTransfer
    {
        if ($budget === null) {
            $budget = $this->config->getInitialBudget();
        }

        $orderBudgetTransfer = (new OrderBudgetTransfer())->setBudget($budget);

        return $this->entityManager->createOrderBudget($orderBudgetTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function update(OrderBudgetTransfer $orderBudgetTransfer): void
    {
        $this->entityManager->updateOrderBudget($orderBudgetTransfer);
    }
}
