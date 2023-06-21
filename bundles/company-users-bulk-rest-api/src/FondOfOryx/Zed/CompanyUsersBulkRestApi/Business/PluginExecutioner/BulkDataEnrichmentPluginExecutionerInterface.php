<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;

interface BulkDataEnrichmentPluginExecutionerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePrePlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function executePostPlugins(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer;
}
