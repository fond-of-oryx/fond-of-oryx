<?php

namespace FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterPostDeletePluginInterface
{
    public function execute(CompanyTransfer $companyTransfer): void;
}