<?php
namespace FondOfOryx\Client\ErpOrderPageSearch\Zed;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderCollectionTransfer;

/**
 * Interface ErpOrderPageSearchStubInterface
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch\Zed
 */
interface ErpOrderPageSearchStubInterface
{
    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer  $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderCollectionTransfer;
}
