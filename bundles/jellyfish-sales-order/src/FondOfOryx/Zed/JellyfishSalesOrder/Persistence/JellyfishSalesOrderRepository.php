<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderPersistenceFactory getFactory()
 */
class JellyfishSalesOrderRepository extends AbstractRepository implements JellyfishSalesOrderRepositoryInterface
{
    /**
     * @param string $name
     *
     * @return int|null
     */
    public function getIdOmsOrderItemStateByName(string $name): ?int
    {
        $entity = $this->getFactory()
            ->getOmsOrderItemStateQuery()
            ->clear()
            ->findOneByName($name);

        if ($entity === null) {
            return null;
        }

        return $entity->getIdOmsOrderItemState();
    }
}
