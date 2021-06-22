<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use Exception;
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
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_FORMAT, 'png');
    }

    /**
     * @return string|null
     */
    public function getEncoding(): ?string
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ENCODING_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return int|null
     */
    public function getErrorCorrectionLevel(): ?int
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ERROR_CORRECTION_LEVEL_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_SIZE_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return int|null
     */
    public function getMargin(): ?int
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_MARGIN_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return int|null
     */
    public function getRoundedBlockSizeMode(): ?int
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_ROUNDED_BLOCK_SIZE_MODE_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return array|null
     */
    public function getForegroundColor(): ?array
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_FOREGROUND_COLOR_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return array|null
     */
    public function getBackgroundColor(): ?array
    {
        try {
            return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_QR_CODE_BACKGROUND_COLOR_OVERRIDE);
        } catch (Exception $exception) {
            return null;
        }
    }
}
