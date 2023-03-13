<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyToProductListDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteProductListDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
