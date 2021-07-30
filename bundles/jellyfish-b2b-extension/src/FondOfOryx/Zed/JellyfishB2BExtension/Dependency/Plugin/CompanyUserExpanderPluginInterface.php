<?php

namespace FondOfOryx\Zed\JellyfishB2BExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands CompanyUserTransfer Object
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function expand(
        CompanyUserTransfer $companyUserTransfer
    ): CompanyUserTransfer;
}
