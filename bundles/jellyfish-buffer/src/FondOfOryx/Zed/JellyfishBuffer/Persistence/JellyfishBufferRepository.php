<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\Base\FooExportedOrderQuery as OrmFooExportedOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory getFactory()
 */
class JellyfishBufferRepository extends AbstractRepository implements JellyfishBufferRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findBufferedOrders(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): ExportedOrderCollectionTransfer
    {
        $query = $this->createQueryFromFilterTransfer($jellyfishBufferTableFilterTransfer);
        $results = $query->find();
        $collection = new ExportedOrderCollectionTransfer();
        $mapper = $this->getFactory()->createJellyfishBufferMapper();
        $count = 0;
        foreach ($results->getData() as $entity) {
            $collection->addOrder($mapper->fromEntity($entity));
            $count++;
        }

        return $collection->setCount($count);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return \Orm\Zed\JellyfishBuffer\Persistence\Base\FooExportedOrderQuery
     */
    protected function createQueryFromFilterTransfer(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): OrmFooExportedOrderQuery
    {
        $query = $this->getFactory()->createExportedOrderQuery();

        if ($jellyfishBufferTableFilterTransfer->getForceReexport() === false) {
            $query->filterByIsReexported(false);
        }

        if ($jellyfishBufferTableFilterTransfer->getStore()) {
            $query->filterByStore($jellyfishBufferTableFilterTransfer->getStore());
        }

        if (count($jellyfishBufferTableFilterTransfer->getIds()) > 0) {
            return $query->filterByFkSalesOrder_In($jellyfishBufferTableFilterTransfer->getIds());
        }

        return $query->filterByFkSalesOrder_Between([
            'min' => $jellyfishBufferTableFilterTransfer->getRangeFrom(),
            'max' => $jellyfishBufferTableFilterTransfer->getRangeTo(),
        ]);
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer|null
     */
    public function getExportedOrderById(int $idExportedOrder): ?ExportedOrderTransfer
    {
        $query = $this->getFactory()->createExportedOrderQuery();
        $query->joinWithOrder();
        $entity = $query->findOneByIdExportedOrder($idExportedOrder);

        if ($entity === null) {
            return null;
        }

        return $this->getFactory()->createJellyfishBufferMapper()->fromEntity($entity);
    }

    /**
     * @param int $fkSalesOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findExportedOrdersByFkSalesOrder(int $fkSalesOrder): ExportedOrderCollectionTransfer
    {
        $query = $this->getFactory()->createExportedOrderQuery();
        $query->filterByFkSalesOrder($fkSalesOrder);
        $results = $query->find();
        $collection = new ExportedOrderCollectionTransfer();
        $mapper = $this->getFactory()->createJellyfishBufferMapper();
        $count = 0;
        foreach ($results->getData() as $entity) {
            $collection->addOrder($mapper->fromEntity($entity));
            $count++;
        }

        return $collection->setCount($count);
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer
     */
    public function findHistoryEntriesByIdExportedOrder(int $idExportedOrder): ExportedOrderHistoryCollectionTransfer
    {
        $query = $this->getFactory()->createExportedOrderHistoryQuery()->joinWithSpyUser();
        $results = $query->filterByFkExportedOrder($idExportedOrder)->orderByExportedAt(Criteria::DESC)->find()->getData();

        $collection = new ExportedOrderHistoryCollectionTransfer();

        foreach ($results as $historyEntry) {
            $collection->addOrderHistory($this->getFactory()->createJellyfishBufferMapper()->fromHistoryEntity($historyEntry));
        }

        return $collection;
    }
}
