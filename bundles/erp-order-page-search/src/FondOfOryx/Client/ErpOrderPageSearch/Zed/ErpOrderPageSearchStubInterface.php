<?php
namespace FondOfOryx\Client\ErpOrderPageSearch\Zed;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;

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
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderPageSearchTransfer;
}
