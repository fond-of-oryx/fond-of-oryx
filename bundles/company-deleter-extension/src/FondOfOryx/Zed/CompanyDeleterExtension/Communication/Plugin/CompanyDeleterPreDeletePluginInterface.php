<?php

namespace FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function execute(CompanyTransfer $companyTransfer): void;
}
