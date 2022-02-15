<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business;

use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandler;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ErpDeliveryNoteFacade
 *
 * @package FondOfOryx\Zed\ErpDeliveryNote\Business
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface getRepository()
 */
class ErpDeliveryNoteFacade extends AbstractFacade implements ErpDeliveryNoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function createErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        return $this->getFactory()->createErpDeliveryNoteWriter()->create($erpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function updateErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        return $this->getFactory()->createErpDeliveryNoteWriter()->update($erpDeliveryNoteTransfer);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): void
    {
        $this->getFactory()->createErpDeliveryNoteWriter()->delete($idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer
    {
        return $this->getFactory()->createErpDeliveryNoteReader()->findErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function persistBillingAddress(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFactory()->createErpDeliveryNoteAddressHandler()->handle($erpDeliveryNoteTransfer, ErpDeliveryNoteAddressHandler::BILLING_TYPE, $existingErpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function persistShippingAddress(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFactory()->createErpDeliveryNoteAddressHandler()->handle($erpDeliveryNoteTransfer, ErpDeliveryNoteAddressHandler::SHIPPING_TYPE, $existingErpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function persistErpDeliveryNoteItem(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFactory()->createErpDeliveryNoteItemHandler()->handle($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function persistErpDeliveryNoteExpense(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFactory()->createErpDeliveryNoteExpenseHandler()->handle($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
    }
}
