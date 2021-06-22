<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

interface QrCodeGeneratorServiceInterface
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
