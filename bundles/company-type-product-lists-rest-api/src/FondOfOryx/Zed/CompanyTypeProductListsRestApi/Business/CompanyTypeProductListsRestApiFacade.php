<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiBusinessFactory getFactory()
 */
class CompanyTypeProductListsRestApiFacade extends AbstractFacade implements CompanyTypeProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expandRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateRequestTransfer {
        return $this->getFactory()
            ->createRestProductListUpdateRequestExpander()
            ->expand($restProductListUpdateRequestTransfer);
    }
}
