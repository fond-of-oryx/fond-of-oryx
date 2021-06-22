<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model\Builder;

use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface EpcDataBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return string
     */
    public function fromTransfer(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): string;
}
