<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Endroid\QrCode\Writer\Result\ResultInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

interface QrCodeWrapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     */
    public function createQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): ResultInterface;
}
