<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Model;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpInvoiceApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function create(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpInvoice
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpInvoice, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpInvoice): ApiItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpInvoice): ApiItemTransfer;
}
