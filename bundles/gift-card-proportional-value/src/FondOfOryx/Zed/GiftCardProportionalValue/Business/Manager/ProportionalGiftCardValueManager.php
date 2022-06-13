<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager;

use FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class ProportionalGiftCardValueManager implements ProportionalGiftCardValueManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface
     */
    protected $pluginExecutor;

    /**
     * @param \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface $pluginExecutor
     */
    public function __construct(
        GiftCardProportionalValueEntityManagerInterface $entityManager,
        ProportionalValueCalculatorPluginExecutorInterface $pluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->pluginExecutor = $pluginExecutor;
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function createProportionalValues(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        foreach ($this->pluginExecutor->execute($orderEntity) as &$proportionalGiftCardValue) {
            $proportionalGiftCardValue = $this->entityManager->findOrCreateProportionalGiftCardValue($proportionalGiftCardValue);
        }

        return $orderItems;
    }
}
