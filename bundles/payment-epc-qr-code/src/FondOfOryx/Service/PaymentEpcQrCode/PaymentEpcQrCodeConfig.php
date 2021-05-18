<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Shared\PaymentEpcQrCode\PaymentEpcQrCodeConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

/**
 * Class PaymentEpcQrCodeConfig
 *
 * @package FondOfOryx\Service\PaymentEpcQrCode
 */
class PaymentEpcQrCodeConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_ENCODING, 'UTF-8');
    }

    /**
     * @return int
     */
    public function getErrorCorrectionLevel(): int
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_ERROR_CORRECTION_LEVEL, 1);
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_SIZE, 250);
    }

    /**
     * @return int
     */
    public function getMargin(): int
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_MARGIN, 10);
    }

    /**
     * @return int
     */
    public function getRoundedBlockSizeMode(): int
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_ROUNDED_BLOCK_SIZE_MODE, 1);
    }

    /**
     * @return array
     */
    public function getForegroundColor(): array
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_FOREGROUND_COLOR, [0, 0, 0]);
    }

    /**
     * @return array
     */
    public function getBackgroundColor(): array
    {
        return $this->get(PaymentEpcQrCodeConstants::QR_CODE_BACKGROUND_COLOR, [255, 255, 255]);
    }
}
