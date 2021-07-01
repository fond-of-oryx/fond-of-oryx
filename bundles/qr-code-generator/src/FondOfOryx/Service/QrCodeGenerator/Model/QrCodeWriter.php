<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class QrCodeWriter implements QrCodeWriterInterface
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface
     */
    protected $wrapper;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    protected $qrCode;

    /**
     * @param \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface $wrapper
     * @param \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface $qrCode
     */
    public function __construct(QrCodeWrapperInterface $wrapper, QrCodeInterface $qrCode)
    {
        $this->wrapper = $wrapper;
        $this->qrCode = $qrCode;
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function generateQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): QrCodeInterface
    {
        return (clone $this->qrCode)->init($this->wrapper->createQrCode($qrCodeGeneratorRequestTransfer));
    }
}
