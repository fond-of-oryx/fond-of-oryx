<?php

namespace FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function expand(CompanyTransfer $companyTransfer): CompanyTransfer;
}
