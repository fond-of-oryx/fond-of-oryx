<?php

namespace FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig getConfig()
 */
class ErpOrderApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpOrderApiConfig::RESOURCE_ERP_ORDERS;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->createErpOrder($apiDataTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($id): ApiItemTransfer
    {
        return $this->getFacade()->getErpOrder($id);
    }

    /**
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->updateErpOrder($id, $apiDataTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($id): ApiItemTransfer
    {
        return $this->getFacade()->deleteErpOrder($id);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findErpOrders($apiRequestTransfer);
    }
}
