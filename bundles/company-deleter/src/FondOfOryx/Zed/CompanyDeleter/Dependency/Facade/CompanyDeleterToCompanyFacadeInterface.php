<?php

namespace FondOfOryx\Zed\CompanyDeleter\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterToCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function delete(CompanyTransfer $companyTransfer): void;
}
