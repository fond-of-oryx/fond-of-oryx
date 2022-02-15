<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpDeliveryNoteApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function create(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpDeliveryNote
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpDeliveryNote, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpDeliveryNote): ApiItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpDeliveryNote): ApiItemTransfer;
}
