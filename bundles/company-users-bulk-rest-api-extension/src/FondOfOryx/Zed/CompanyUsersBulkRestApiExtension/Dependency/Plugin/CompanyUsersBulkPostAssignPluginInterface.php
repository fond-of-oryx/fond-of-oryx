<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

interface CompanyUsersBulkPostAssignPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer
     */
    public function postAssign(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkRequestTransfer;
}