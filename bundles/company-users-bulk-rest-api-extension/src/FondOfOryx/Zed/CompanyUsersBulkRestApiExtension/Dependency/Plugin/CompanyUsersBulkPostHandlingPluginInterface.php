<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

interface CompanyUsersBulkPostHandlingPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer
     */
    public function postHandling(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkRequestTransfer;
}
