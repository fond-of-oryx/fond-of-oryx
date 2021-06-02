<?php

namespace FondOfOryx\Zed\CreditMemoApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CreditMemoApi\CreditMemoApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\ApiDispatchingException;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CreditMemoApi\CreditMemoApiConfig getConfig()
 */
class CreditMemoApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @param int $idCreditMemo
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($idCreditMemo): ApiItemTransfer
    {
        throw new ApiDispatchingException('Add method is not implemented yet.', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idCreditMemo
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($idCreditMemo, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        throw new ApiDispatchingException('Update method is not implemented yet.', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->addCreditMemo($apiDataTransfer);
    }

    /**
     * @param int $idStock
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($idStock): ApiItemTransfer
    {
        throw new ApiDispatchingException('Remove method not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        throw new ApiDispatchingException('Find method not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CreditMemoApiConfig::RESOURCE_CREDIT_MEMO;
    }
}
