<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Persistence;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpInvoiceApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
