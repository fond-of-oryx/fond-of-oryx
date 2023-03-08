<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;
use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface;

interface CompanyDeleterInterface
{
    public function delete(array $idCompanies): void;
}