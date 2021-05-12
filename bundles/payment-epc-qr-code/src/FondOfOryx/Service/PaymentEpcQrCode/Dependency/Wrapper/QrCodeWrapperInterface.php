<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper;

use Endroid\QrCode\Writer\Result\ResultInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

interface QrCodeWrapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): ResultInterface;
}
