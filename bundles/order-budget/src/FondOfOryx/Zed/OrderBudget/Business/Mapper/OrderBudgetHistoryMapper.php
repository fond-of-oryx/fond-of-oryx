<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Mapper;

use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetHistoryMapper implements OrderBudgetHistoryMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface
     */
    protected $utilDateTimeService;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService
     */
    public function __construct(OrderBudgetToUtilDateTimeServiceInterface $utilDateTimeService)
    {
        $this->utilDateTimeService = $utilDateTimeService;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetHistoryTransfer
     */
    public function fromOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): OrderBudgetHistoryTransfer
    {
        $orderBudgetHistoryTransfer = (new OrderBudgetHistoryTransfer())->fromArray(
            $orderBudgetTransfer->toArray(),
            true,
        );

        $validFrom = $this->utilDateTimeService->formatDate($orderBudgetTransfer->getUpdatedAt());

        return $orderBudgetHistoryTransfer
            ->setFkOrderBudget($orderBudgetTransfer->getIdOrderBudget())
            ->setValidFrom($validFrom);
    }
}
