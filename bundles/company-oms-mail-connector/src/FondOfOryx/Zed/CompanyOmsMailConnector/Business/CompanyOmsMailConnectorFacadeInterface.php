<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface CompanyOmsMailConnectorFacadeInterface
{
    /**
     * Specification:
     *  - Expands order mail transfer data with company business unit e-mail address.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransferWithCompanyMailAddress(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer;

    /**
     * Specification:
     *  - Expands order mail transfer data with company locale.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransferWithCompanyLocale(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer;
}
