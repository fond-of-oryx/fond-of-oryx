<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface EpcQrCodeGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function generateEpcQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
