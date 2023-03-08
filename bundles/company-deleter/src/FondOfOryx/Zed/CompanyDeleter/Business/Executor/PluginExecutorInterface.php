<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Executor;

use Generated\Shared\Transfer\CompanyTransfer;

interface PluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function executePreDeletePlugins(CompanyTransfer $companyTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function executePostDeletePlugins(CompanyTransfer $companyTransfer): void;
}
