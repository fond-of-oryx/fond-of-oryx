<?php
namespace FondOfOryx\Client\ErpOrderPageSearch;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;

/**
 * Interface ErpOrderPageSearchClientInterface
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
interface ErpOrderPageSearchClientInterface
{
    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer  $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderPageSearchTransfer;
}
