<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface PaymentEpcQrCodeServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
