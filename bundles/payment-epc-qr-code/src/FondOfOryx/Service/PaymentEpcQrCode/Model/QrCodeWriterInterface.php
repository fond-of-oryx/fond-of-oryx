<?php
namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface QrCodeWriterInterface
{
    /**
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     * @throws \Exception
     */
    public function generateQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
