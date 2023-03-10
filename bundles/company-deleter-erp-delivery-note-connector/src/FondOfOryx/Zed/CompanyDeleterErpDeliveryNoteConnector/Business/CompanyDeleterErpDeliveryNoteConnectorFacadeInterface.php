<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpDeliveryNoteConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteErpDeliveryNoteDataForCompanyById(CompanyTransfer $companyTransfer): void;
}