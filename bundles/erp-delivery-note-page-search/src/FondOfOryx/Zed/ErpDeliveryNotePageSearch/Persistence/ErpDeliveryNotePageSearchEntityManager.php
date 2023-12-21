<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchPersistenceFactory getFactory()
 */
class ErpDeliveryNotePageSearchEntityManager extends AbstractEntityManager implements ErpDeliveryNotePageSearchEntityManagerInterface
{
    /**
     * @param array $erpDeliveryNoteIds
     *
     * @return void
     */
    public function deleteErpDeliveryNoteSearchPagesByErpDeliveryNoteIds(array $erpDeliveryNoteIds): void
    {
        $entities = $this->getFactory()->getErpDeliveryNotePageSearchQuery()->filterByFkErpDeliveryNote_In($erpDeliveryNoteIds)->find();

        foreach ($entities as $entity) {
            $entity->delete();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
     *
     * @return void
     */
    public function persistErpDeliveryNotePageSearch(
        ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
    ): void {
        $fooErpDeliveryNotePageSearch = $this->getFactory()->getErpDeliveryNotePageSearchQuery()
            ->filterByFkErpDeliveryNote($erpDeliveryNotePageSearchTransfer->getFkErpDeliveryNote())
            ->findOneOrCreate();

        $fooErpDeliveryNotePageSearch = $this->getFactory()->createErpDeliveryNotePageSearchMapper()
            ->mapTransferToEntity($erpDeliveryNotePageSearchTransfer, $fooErpDeliveryNotePageSearch);

        $fooErpDeliveryNotePageSearch->save();
    }
}
