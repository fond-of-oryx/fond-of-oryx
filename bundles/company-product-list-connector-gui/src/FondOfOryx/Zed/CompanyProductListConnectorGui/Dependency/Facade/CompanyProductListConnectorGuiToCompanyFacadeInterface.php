<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyProductListConnectorGuiToCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;
}
