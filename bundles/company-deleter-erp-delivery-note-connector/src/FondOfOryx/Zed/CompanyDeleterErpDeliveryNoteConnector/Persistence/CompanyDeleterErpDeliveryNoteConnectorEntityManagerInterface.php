<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdCompany(CompanyTransfer $companyTransfer): void;
}
