<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiBusinessFactory getFactory()
 */
class ErpOrderApiFacade extends AbstractFacade implements ErpOrderApiFacadeInterface
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
    public function createErpOrder(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpOrderApi()
            ->create($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpOrder(int $idErpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpOrderApi()
            ->update($idErpOrder, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpOrder(int $idErpOrder): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpOrderApi()
            ->get($idErpOrder);
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
    public function findErpOrders(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()
            ->createErpOrderApi()
            ->find($apiRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpOrder(int $idErpOrder): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpOrderApi()
            ->delete($idErpOrder);
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
    public function validateErpOrder(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFactory()
            ->createErpOrderApiValidator()
            ->validate($apiRequestTransfer);
    }
}
