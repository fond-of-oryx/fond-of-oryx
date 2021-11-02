<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemMapper implements JellyfishOrderItemMapperInterface
{
    /**
     * @var array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderItemExpanderPostMapPluginInterface>
     */
    protected $jellyfishOrderItemExpanderPostMapPlugins;

    /**
     * @param array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderItemExpanderPostMapPluginInterface> $jellyfishOrderItemExpanderPostMapPlugins
     */
    public function __construct(array $jellyfishOrderItemExpanderPostMapPlugins)
    {
        $this->jellyfishOrderItemExpanderPostMapPlugins = $jellyfishOrderItemExpanderPostMapPlugins;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function fromSalesOrderItem(SpySalesOrderItem $salesOrderItem): JellyfishOrderItemTransfer
    {
        $jellyfishOrderItemTransfer = new JellyfishOrderItemTransfer();

        $quantity = $salesOrderItem->getQuantity();

        $jellyfishOrderItemTransfer->setSku($salesOrderItem->getSku())
            ->setId($salesOrderItem->getIdSalesOrderItem())
            ->setName($salesOrderItem->getName())
            ->setQuantity($salesOrderItem->getQuantity())
            ->setTaxRate((float)$salesOrderItem->getTaxRate())
            ->setUnitPrice((int)round($salesOrderItem->getPrice() / $quantity))
            ->setUnitPriceToPayAggregation((int)round($salesOrderItem->getPriceToPayAggregation() / $quantity))
            ->setUnitTaxAmount((int)round($salesOrderItem->getTaxAmount() / $quantity))
            ->setUnitDiscountAmountAggregation((int)round($salesOrderItem->getDiscountAmountAggregation() / $quantity))
            ->setUnitDiscountAmountFullAggregation((int)round($salesOrderItem->getDiscountAmountFullAggregation() / $quantity))
            ->setSumTaxAmount($salesOrderItem->getTaxAmount())
            ->setSumPrice($salesOrderItem->getPrice())
            ->setSumPriceToPayAggregation($salesOrderItem->getPriceToPayAggregation())
            ->setSumDiscountAmountAggregation($salesOrderItem->getDiscountAmountAggregation())
            ->setSumDiscountAmountFullAggregation($salesOrderItem->getDiscountAmountFullAggregation());

        return $this->expandOrderItemTransfer($jellyfishOrderItemTransfer, $salesOrderItem);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected function expandOrderItemTransfer(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $salesOrderItem
    ): JellyfishOrderItemTransfer {
        foreach ($this->jellyfishOrderItemExpanderPostMapPlugins as $jellyfishOrderItemExpanderPostMapPlugin) {
            $jellyfishOrderItemTransfer = $jellyfishOrderItemExpanderPostMapPlugin->expand($jellyfishOrderItemTransfer, $salesOrderItem);
        }

        return $jellyfishOrderItemTransfer;
    }
}
