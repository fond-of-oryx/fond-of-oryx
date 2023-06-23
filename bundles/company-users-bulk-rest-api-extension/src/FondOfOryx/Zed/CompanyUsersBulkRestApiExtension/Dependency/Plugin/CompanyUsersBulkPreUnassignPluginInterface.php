<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

interface CompanyUsersBulkPreUnassignPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer
     */
    public function preUnassign(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkRequestTransfer;
}
