<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface QrCodeWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @throws \Exception
     *
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    public function generateQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
