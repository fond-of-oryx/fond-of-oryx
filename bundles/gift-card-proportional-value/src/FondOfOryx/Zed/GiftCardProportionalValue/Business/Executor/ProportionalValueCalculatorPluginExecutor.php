<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class ProportionalValueCalculatorPluginExecutor implements ProportionalValueCalculatorPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface>
     */
    protected $calculationPlugins;

    /**
     * @param array $calculationPlugins
     */
    public function __construct(array $calculationPlugins)
    {
        $this->calculationPlugins = $calculationPlugins;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function execute(SpySalesOrder $orderEntity): ArrayObject
    {
        $proportionalGiftCardValues = new ArrayObject();
        foreach ($this->calculationPlugins as $calculationPlugin) {
            $proportionalGiftCardValues = $calculationPlugin->calculate($orderEntity, $proportionalGiftCardValues);
        }

        return $proportionalGiftCardValues;
    }
}
