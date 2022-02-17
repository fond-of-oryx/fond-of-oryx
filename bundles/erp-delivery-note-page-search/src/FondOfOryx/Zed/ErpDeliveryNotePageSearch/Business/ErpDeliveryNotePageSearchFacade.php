<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 */
class ErpDeliveryNotePageSearchFacade extends AbstractFacade implements ErpDeliveryNotePageSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpDeliveryNoteIds
     *
     * @return void
     */
    public function publish(array $erpDeliveryNoteIds): void
    {
        $this->getFactory()
            ->createErpDeliveryNotePageSearchPublisher()
            ->publish($erpDeliveryNoteIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpDeliveryNoteIds
     *
     * @return void
     */
    public function unpublish(array $erpDeliveryNoteIds): void
    {
        $this->getFactory()->createErpDeliveryNotePageSearchUnPublisher()
            ->unpublish($erpDeliveryNoteIds);
    }
}
