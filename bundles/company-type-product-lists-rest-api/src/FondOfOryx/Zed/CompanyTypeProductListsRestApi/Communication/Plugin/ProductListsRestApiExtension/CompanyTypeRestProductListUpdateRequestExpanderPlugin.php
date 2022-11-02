<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\RestProductListUpdateRequestExpanderPluginInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiFacadeInterface getFacade()
 */
class CompanyTypeRestProductListUpdateRequestExpanderPlugin extends AbstractPlugin implements RestProductListUpdateRequestExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expand(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateRequestTransfer {
        return $this->getFacade()->expandRestProductListUpdateRequest($restProductListUpdateRequestTransfer);
    }
}
