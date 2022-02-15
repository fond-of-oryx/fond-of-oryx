<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig getConfig()
 */
class ErpDeliveryNoteApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpDeliveryNoteApiConfig::RESOURCE_ERP_DELIVERY_NOTES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->createErpDeliveryNote($apiDataTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($id): ApiItemTransfer
    {
        return $this->getFacade()->getErpDeliveryNote($id);
    }

    /**
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->updateErpDeliveryNote($id, $apiDataTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($id): ApiItemTransfer
    {
        return $this->getFacade()->deleteErpDeliveryNote($id);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findErpDeliveryNotes($apiRequestTransfer);
    }
}
