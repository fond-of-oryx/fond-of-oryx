<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

interface QrCodeWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @throws \Exception
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function generateQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): QrCodeInterface;
}
