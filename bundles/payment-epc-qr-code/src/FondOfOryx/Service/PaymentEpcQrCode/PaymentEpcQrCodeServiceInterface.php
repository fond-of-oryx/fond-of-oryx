<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use Endroid\QrCode\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface PaymentEpcQrCodeServiceInterface
{
    /**
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\QrCodeInterface
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
