<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceFactory getFactory()
 */
class PaymentEpcQrCodeService extends AbstractService implements PaymentEpcQrCodeServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function createEpcQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface
    {
        return $this->getFactory()->createEpcQrCodeGenerator()->generateEpcQrCode($paymentEpcQrCodeRequestTransfer);
    }
}
