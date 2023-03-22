<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpDeliveryNoteConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteErpDeliveryNoteDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
