<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiBusinessFactory getFactory()
 */
class CustomerProductListApiFacade extends AbstractFacade implements CustomerProductListApiFacadeInterface
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
    public function addCustomerProductList(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createCustomerProductListApi()
            ->add($apiDataTransfer);
    }
}
