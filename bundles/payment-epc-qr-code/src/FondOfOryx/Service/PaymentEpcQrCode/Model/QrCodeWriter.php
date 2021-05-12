<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapperInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class QrCodeWriter implements QrCodeWriterInterface
{
    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapperInterface
     */
    protected $wrapper;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    protected $qrCode;

    /**
     * @param \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapperInterface $wrapper
     * @param \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface $qrCode
     */
    public function __construct(QrCodeWrapperInterface $wrapper, QrCodeInterface $qrCode)
    {
        $this->wrapper = $wrapper;
        $this->qrCode = $qrCode;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    public function generateQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface
    {
        return (clone $this->qrCode)->init($this->wrapper->createQrCode($paymentEpcQrCodeRequestTransfer));
    }
}
