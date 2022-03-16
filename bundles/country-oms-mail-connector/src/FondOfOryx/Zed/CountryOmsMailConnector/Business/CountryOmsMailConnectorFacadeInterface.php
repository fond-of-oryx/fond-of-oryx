<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface CountryOmsMailConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Allows using address country information (iso2 code, iso3 code, ...) in mail template
     * - Expands billing address with country information (iso2 code, iso3 code, ...)
     * - Expands shipping address(es) with country information (iso2 code, iso3 code, ...)
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOmsOrderMail(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer;
}
