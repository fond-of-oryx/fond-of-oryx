<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacadeInterface getFacade()
 */
class ErpDeliveryNoteApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
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
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validateErpDeliveryNote($apiDataTransfer);
    }
}
