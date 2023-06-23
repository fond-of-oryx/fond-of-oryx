<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;

interface CompanyUsersBulkItemPostEnrichmentPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer
     */
    public function postEnrichment(
        CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
    ): CompanyUsersBulkPreparationTransfer;
}
