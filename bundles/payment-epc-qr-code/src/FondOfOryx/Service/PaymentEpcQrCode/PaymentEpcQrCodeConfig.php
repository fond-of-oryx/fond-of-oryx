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
    public function getFormat(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_FORMAT, 'pdf');
    }

    /**
     * @return string|null
     */
    public function getEncoding(): ?string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ENCODING_OVERRIDE);
    }

    /**
     * @return int|null
     */
    public function getErrorCorrectionLevel(): ?int
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ERROR_CORRECTION_LEVEL_OVERRIDE);
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_SIZE_OVERRIDE);
    }

    /**
     * @return int|null
     */
    public function getMargin(): ?int
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_MARGIN_OVERRIDE);
    }

    /**
     * @return int|null
     */
    public function getRoundedBlockSizeMode(): ?int
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ROUNDED_BLOCK_SIZE_MODE_OVERRIDE);
    }

    /**
     * @return array|null
     */
    public function getForegroundColor(): ?array
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_FOREGROUND_COLOR_OVERRIDE);
    }

    /**
     * @return array|null
     */
    public function getBackgroundColor(): ?array
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_BACKGROUND_COLOR_OVERRIDE);
    }
}
