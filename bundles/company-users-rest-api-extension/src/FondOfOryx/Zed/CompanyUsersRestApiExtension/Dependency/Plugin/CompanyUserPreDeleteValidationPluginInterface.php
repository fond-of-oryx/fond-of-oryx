<?php

namespace FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestDeleteCompanyUserRequestTransfer;

interface CompanyUserPreDeleteValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestDeleteCompanyUserRequestTransfer $restDeleteCompanyUserRequestTransfer
     *
     * @return bool
     */
    public function validate(
        CompanyUserTransfer $companyUserTransfer,
        RestDeleteCompanyUserRequestTransfer $restDeleteCompanyUserRequestTransfer
    ): bool;
}
