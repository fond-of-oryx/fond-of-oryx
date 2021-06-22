<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\PaymentEpcQrCode\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface PaymentEpcQrCodeFacadeInterface
{
    /**
     * Specification:
     *  - Expands order mail transfer data with PaymentEpcQrCode groups data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransfer(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer;
}
