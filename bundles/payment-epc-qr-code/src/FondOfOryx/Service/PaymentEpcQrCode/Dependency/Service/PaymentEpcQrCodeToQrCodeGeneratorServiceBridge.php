<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class PaymentEpcQrCodeToQrCodeGeneratorServiceBridge implements PaymentEpcQrCodeToQrCodeGeneratorServiceInterface
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceInterface
     */
    protected $service;

    /**
     * @param \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceInterface $qrCodeGeneratorService
     */
    public function __construct(QrCodeGeneratorServiceInterface $qrCodeGeneratorService)
    {
        $this->service = $qrCodeGeneratorService;
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function createQrCode(
        QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
    ): QrCodeInterface {
        return $this->service->createQrCode($qrCodeGeneratorRequestTransfer);
    }
}
