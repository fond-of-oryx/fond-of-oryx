<?php

namespace FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserPostCreatePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after Company User is created.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function postCreate(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer;
}
