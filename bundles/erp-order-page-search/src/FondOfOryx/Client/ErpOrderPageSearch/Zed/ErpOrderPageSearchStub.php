<?php
namespace FondOfOryx\Client\ErpOrderPageSearch\Zed;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;

/**
 * Class ErpOrderPageSearchStub
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch\Zed
 */
class ErpOrderPageSearchStub extends ZedRequestStub implements ErpOrderPageSearchStubInterface
{
    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer  $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderPageSearchTransfer
    {
        return $this->zedStub->call('/erp-order-page-search/gateway/get-erp-order-by-request', $request);
    }
}
