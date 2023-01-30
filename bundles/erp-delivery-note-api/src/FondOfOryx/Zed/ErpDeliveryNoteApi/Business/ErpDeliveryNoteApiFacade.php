<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiBusinessFactory getFactory()
 */
class ErpDeliveryNoteApiFacade extends AbstractFacade implements ErpDeliveryNoteApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createErpDeliveryNote(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApi()
            ->create($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpDeliveryNote(int $idErpDeliveryNote, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApi()
            ->update($idErpDeliveryNote, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpDeliveryNote(int $idErpDeliveryNote): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApi()
            ->get($idErpDeliveryNote);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findErpDeliveryNotes(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApi()
            ->find($apiRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpDeliveryNote(int $idErpDeliveryNote): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApi()
            ->delete($idErpDeliveryNote);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validateErpDeliveryNote(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFactory()
            ->createErpDeliveryNoteApiValidator()
            ->validate($apiRequestTransfer);
    }
}
