<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface getFacade()
 */
class CustomerByEmailResolverPreDataExpanderPlugin extends AbstractPlugin implements CompanyUsersBulkDataExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer {
        return $this->getFacade()->expandWithCustomerByMail($companyUsersBulkPreparationCollectionTransfer);
    }
}
