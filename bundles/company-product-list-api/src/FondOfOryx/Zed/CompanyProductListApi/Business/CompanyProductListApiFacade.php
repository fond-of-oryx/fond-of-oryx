<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyProductListApi\Business\CompanyProductListApiBusinessFactory getFactory()
 */
class CompanyProductListApiFacade extends AbstractFacade implements CompanyProductListApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyProductList(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createCompanyProductListApi()
            ->add($apiDataTransfer);
    }
}
