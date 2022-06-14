<?php

namespace FondOfOryx\Zed\ProductListApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ProductListApi\ProductListApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ProductListApi\Business\ProductListApiFacadeInterface getFacade()
 */
class ProductListApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @param int $idProductList
     *
     * @throws \RuntimeException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($idProductList): ApiItemTransfer
    {
        throw new RuntimeException('Add action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idProductList
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \RuntimeException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($idProductList, ApiDataTransfer $apiDataTransfer)
    {
        throw new RuntimeException('Update action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \RuntimeException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        throw new RuntimeException('Update action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idProductList
     *
     * @throws \RuntimeException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($idProductList): ApiItemTransfer
    {
        throw new RuntimeException('Remove action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findProductLists($apiRequestTransfer);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getResourceName()
    {
        return ProductListApiConfig::RESOURCE_PRODUCT_LIST;
    }
}
