<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * Class ErpOrderPageSearchEntityManager
 * @package FondOfOryx\Zed\ErpOrderPageSearch\Persistence
 *
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory getFactory()
 */
class ErpOrderPageSearchEntityManager extends AbstractEntityManager implements ErpOrderPageSearchEntityManagerInterface
{
    /**
     * @param array $erpOrderIds
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteErpOrderSearchPagesByErpOrderIds(array $erpOrderIds): void
    {
        $entities = $this->getFactory()->getErpOrderPageSearchQuery()->filterByFkErpOrder_In($erpOrderIds)->find();

        foreach ($entities as $entity) {
            $entity->delete();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function createErpOrderPageSearch(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer): void
    {
        $fooErpOrderPageSearch = $this->getFactory()->createErpOrderPageSearchMapper()->mapTransferToEntity(
            $erpOrderPageSearchTransfer,
            new FooErpOrderPageSearch()
        );

        $fooErpOrderPageSearch->save();
    }
}
