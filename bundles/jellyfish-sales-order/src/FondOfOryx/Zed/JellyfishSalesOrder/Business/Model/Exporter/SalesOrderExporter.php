<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter;

use ArrayObject;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapterInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Log\LoggerTrait;

class SalesOrderExporter implements SalesOrderExporterInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapperInterface
     */
    protected $jellyfishOrderMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface
     */
    protected $jellyfishOrderItemMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface
     */
    protected $jellyfishSalesOrderPluginExecutor;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapterInterface
     */
    protected $adapter;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapperInterface $jellyfishOrderMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface $jellyfishOrderItemMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface $jellyfishSalesOrderPluginExecutor
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapterInterface $adapter
     */
    public function __construct(
        JellyfishOrderMapperInterface $jellyfishOrderMapper,
        JellyfishOrderItemMapperInterface $jellyfishOrderItemMapper,
        JellyfishSalesOrderPluginExecutorInterface $jellyfishSalesOrderPluginExecutor,
        SalesOrderAdapterInterface $adapter
    ) {
        $this->jellyfishOrderMapper = $jellyfishOrderMapper;
        $this->jellyfishOrderItemMapper = $jellyfishOrderItemMapper;
        $this->jellyfishSalesOrderPluginExecutor = $jellyfishSalesOrderPluginExecutor;
        $this->adapter = $adapter;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param array $salesOrderItems
     *
     * @throws \Exception
     *
     * @return void
     */
    public function export(SpySalesOrder $salesOrderEntity, array $salesOrderItems): void
    {
        try {
            $jellyfishOrderTransfer = $this->map($salesOrderEntity, $salesOrderItems);
            $this->adapter->sendRequest($jellyfishOrderTransfer);
        } catch (Exception $exception) {
            $this->getLogger()->error(
                sprintf(
                    'Order %s could not be exported to JellyFish! Message: %s',
                    $salesOrderEntity->getIdSalesOrder(),
                    $exception->getMessage()
                ),
                $exception->getTrace()
            );

            throw $exception;
        }
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected function map(SpySalesOrder $salesOrderEntity, array $salesOrderItems): JellyfishOrderTransfer
    {
        $jellyfishOrderTransfer = $this->jellyfishOrderMapper->fromSalesOrder($salesOrderEntity);
        $jellyfishOrderItems = $this->mapOrderItems($salesOrderItems);

        $jellyfishOrderTransfer->setItems($jellyfishOrderItems);

        return $this->jellyfishSalesOrderPluginExecutor
            ->executePostMapPlugins($jellyfishOrderTransfer, $salesOrderEntity);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return \ArrayObject
     */
    protected function mapOrderItems(array $salesOrderItems): ArrayObject
    {
        $jellyfishOrderItems = new ArrayObject();
        $groupKeyIndexMapping = new ArrayObject();

        foreach ($salesOrderItems as $salesOrderItem) {
            $groupKey = $salesOrderItem->getGroupKey();
            $jellyfishOrderItemTransfer = $this->jellyfishOrderItemMapper->fromSalesOrderItem($salesOrderItem);

            if ($groupKey === null) {
                $jellyfishOrderItems->append($jellyfishOrderItemTransfer);

                continue;
            }

            if ($groupKey !== null && !$groupKeyIndexMapping->offsetExists($groupKey)) {
                $jellyfishOrderItems->append($jellyfishOrderItemTransfer);
                $groupKeyIndexMapping->offsetSet($groupKey, $jellyfishOrderItems->count() - 1);

                continue;
            }

            $index = $groupKeyIndexMapping->offsetGet($groupKey);
            $currentJellyfishOrderItem = $jellyfishOrderItems->offsetGet($index);

            $currentJellyfishOrderItem->setQuantity($currentJellyfishOrderItem->getQuantity() + $jellyfishOrderItemTransfer->getQuantity())
                ->setSumTaxAmount($currentJellyfishOrderItem->getSumTaxAmount() + $jellyfishOrderItemTransfer->getSumTaxAmount())
                ->setSumPrice($currentJellyfishOrderItem->getSumPrice() + $jellyfishOrderItemTransfer->getSumPrice())
                ->setSumPriceToPayAggregation($currentJellyfishOrderItem->getSumPriceToPayAggregation() + $jellyfishOrderItemTransfer->getSumPriceToPayAggregation())
                ->setSumDiscountAmountAggregation($currentJellyfishOrderItem->getSumDiscountAmountAggregation() + $jellyfishOrderItemTransfer->getSumDiscountAmountAggregation())
                ->setSumDiscountAmountFullAggregation($currentJellyfishOrderItem->getSumDiscountAmountFullAggregation() + $jellyfishOrderItemTransfer->getSumDiscountAmountFullAggregation());
        }

        return $jellyfishOrderItems;
    }
}
