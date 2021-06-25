<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use FondOfOryx\Shared\ThirtyFiveUpApi\ThirtyFiveUpApiConstants;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\ApiDispatchingException;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory getFactory()
 */
class ThirtyFiveUpApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @param int $idThirtyFiveUpOrder
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($idThirtyFiveUpOrder): ApiItemTransfer
    {
        throw new ApiDispatchingException('Get method is not implemented yet.', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idThirtyFiveUpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($idThirtyFiveUpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->updateThirtyFiveUpOrder($idThirtyFiveUpOrder, $apiDataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        throw new ApiDispatchingException('Add method is not implemented yet.', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idThirtyFiveUpOrder
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($idThirtyFiveUpOrder): ApiItemTransfer
    {
        throw new ApiDispatchingException('Remove method not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findThirtyFiveUpOrder($apiRequestTransfer);
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ThirtyFiveUpApiConstants::RESOURCE_THIRTY_FIVE_UP_ORDERS_API;
    }
}
