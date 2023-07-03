<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Expander;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;

interface ExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer;
}
