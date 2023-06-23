<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;

interface CompanyUsersBulkItemPreEnrichmentPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function preEnrichment(
        CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
    ): CompanyUsersBulkPreparationTransfer;
}
