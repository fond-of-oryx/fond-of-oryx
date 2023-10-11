<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface InformationMailHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function sendInformationMail(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer;
}
