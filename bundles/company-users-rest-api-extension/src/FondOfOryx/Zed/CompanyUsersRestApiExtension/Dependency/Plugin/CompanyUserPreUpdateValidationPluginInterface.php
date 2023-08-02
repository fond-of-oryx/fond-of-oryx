<?php

namespace FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestWriteCompanyUserRequestTransfer;

interface CompanyUserPreUpdateValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestWriteCompanyUserRequestTransfer $restWriteCompanyUserRequestTransfer
     * @return bool
     */
    public function validate(
        CompanyUserTransfer $companyUserTransfer,
        RestWriteCompanyUserRequestTransfer $restWriteCompanyUserRequestTransfer
    ): bool;
}
