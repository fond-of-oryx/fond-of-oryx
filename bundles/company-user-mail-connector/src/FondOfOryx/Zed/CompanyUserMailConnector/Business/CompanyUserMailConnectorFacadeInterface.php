<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserMailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function sendMail(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer;
}
