<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Model;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpOrderApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function create(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpOrder): ApiItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpOrder): ApiItemTransfer;
}
