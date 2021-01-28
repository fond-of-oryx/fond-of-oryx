<?php
namespace FondOfOryx\Client\ErpOrderPageSearch;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchClient extends AbstractClient implements ErpOrderPageSearchClientInterface
{
    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface
     */
    protected function getZedStub(): ErpOrderPageSearchStubInterface
    {
        return $this->getFactory()->createZedStub();
    }

    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer  $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderPageSearchTransfer
    {
        return $this->getZedStub()->findErpOrdersByFilterTransfer($request);
    }
}
