<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use Endroid\QrCode\QrCodeInterface;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceFactory getFactory()
 */
class PaymentEpcQrCodeService extends AbstractService implements PaymentEpcQrCodeServiceInterface
{
    /**
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): ResultInterface
    {
        return $this->getFactory()->createQrCodeWriter()->generateQrCode($paymentEpcQrCodeRequestTransfer);
    }
}
