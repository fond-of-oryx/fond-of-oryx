<?php

namespace FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterPreDeletePluginInterface
{
    public function execute(CompanyTransfer $companyTransfer): void;
}