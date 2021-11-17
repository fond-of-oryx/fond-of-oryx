<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Trigger;

use Exception;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrder;
use Spryker\Shared\Log\LoggerTrait;
use Throwable;

class SalesOrderExportTrigger implements SalesOrderExportTriggerInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface
     */
    protected $omsFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface $omsFacade
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig $config
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface $repository
     */
    public function __construct(
        JellyfishSalesOrderToOmsFacadeInterface $omsFacade,
        JellyfishSalesOrderToStoreFacadeInterface $storeFacade,
        JellyfishSalesOrderConfig $config,
        JellyfishSalesOrderQueryContainerInterface $queryContainer,
        JellyfishSalesOrderRepositoryInterface $repository
    ) {
        $this->omsFacade = $omsFacade;
        $this->storeFacade = $storeFacade;
        $this->config = $config;
        $this->queryContainer = $queryContainer;
        $this->repository = $repository;
    }

    /**
     * @return void
     */
    public function trigger(): void
    {
        $stateName = $this->config->getExportPendingStateName();
        $idOmsOrderItemState = $this->repository->getIdOmsOrderItemStateByName($stateName);

        if ($idOmsOrderItemState === null) {
            return;
        }

        $currentStore = $this->storeFacade->getCurrentStore();

        if ($currentStore->getName() === null) {
            return;
        }

        $orderEntities = $this->queryContainer->querySalesOrderByIdOmsOrderItemStateAndStoreName(
            $idOmsOrderItemState,
            $currentStore->getName(),
        )->find();

        foreach ($orderEntities as $orderEntity) {
            $this->triggerByOrderEntityAndIdOmsOrderItemState($orderEntity, $idOmsOrderItemState);
        }
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\Base\SpySalesOrder $orderEntity
     * @param int $idOmsOrderItemState
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function triggerByOrderEntityAndIdOmsOrderItemState(
        SpySalesOrder $orderEntity,
        int $idOmsOrderItemState
    ): void {
        $itemEntities = $orderEntity->getItems();

        foreach ($itemEntities as $itemEntity) {
            if ($itemEntity->getFkOmsOrderItemState() !== $idOmsOrderItemState) {
                return;
            }
        }

        try {
            $data = $this->omsFacade->triggerEvent($this->config->getExportEventName(), $itemEntities, []);

            if ($data !== null) {
                return;
            }

            throw new Exception('Internal oms failure.');
        } catch (Throwable $exception) {
            $this->getLogger()->error(
                sprintf(
                    'Could not trigger sales order export. idSalesOrder: %s | exceptionMessage: %s',
                    $orderEntity->getIdSalesOrder(),
                    $exception->getMessage(),
                ),
                $exception->getTrace(),
            );
        }
    }
}
