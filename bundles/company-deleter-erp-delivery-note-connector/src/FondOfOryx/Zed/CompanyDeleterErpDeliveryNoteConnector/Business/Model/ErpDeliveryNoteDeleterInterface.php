<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface ErpDeliveryNoteDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpDeliveryNoteDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
