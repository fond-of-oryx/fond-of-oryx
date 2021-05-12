<?php


namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use Endroid\QrCode\Writer\Result\ResultInterface;

interface QrCodeInterface extends ResultInterface
{
    /**
     * @param  \Endroid\QrCode\Writer\Result\ResultInterface  $result
     *
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    public function init(ResultInterface $result): QrCodeInterface;
}
