<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Zed;

use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToZedRequestClientInterface;
use Generated\Shared\Transfer\ErpOrderCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;

/**
 * Class ErpOrderPageSearchStub
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch\Zed
 */
class ErpOrderPageSearchStub extends ZedRequestStub implements ErpOrderPageSearchStubInterface
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToZedRequestClientInterface
     */
    protected $zedStub;

    /**
     * @param \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToZedRequestClientInterface $zedStub
     */
    public function __construct(ErpOrderPageSearchToZedRequestClientInterface $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderCollectionTransfer
    {
        return $this->zedStub->call('/erp-order-page-search/gateway/get-erp-order-by-request', $request);
    }
}
