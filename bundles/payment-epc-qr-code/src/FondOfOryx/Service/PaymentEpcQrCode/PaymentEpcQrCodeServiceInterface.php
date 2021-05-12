<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use Endroid\QrCode\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface PaymentEpcQrCodeServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Endroid\QrCode\QrCodeInterface
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface;
}
