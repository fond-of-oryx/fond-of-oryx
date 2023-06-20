<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiBusinessFactory getFactory()
 */
class CompanyUsersBulkRestApiFacade extends AbstractFacade implements CompanyUsersBulkRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function bulkProcess(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkResponseTransfer {
        return $this->getFactory()
            ->createBulkManager()
            ->handleBulkRequest($restCompanyUsersBulkRequestTransfer);
    }
}
