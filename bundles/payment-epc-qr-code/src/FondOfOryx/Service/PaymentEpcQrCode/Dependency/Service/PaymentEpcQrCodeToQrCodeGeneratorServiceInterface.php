<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

interface PaymentEpcQrCodeToQrCodeGeneratorServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @throws \Exception
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function createQrCode(
        QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
    ): QrCodeInterface;
}
