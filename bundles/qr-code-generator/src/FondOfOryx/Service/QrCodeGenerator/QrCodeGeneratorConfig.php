<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use FondOfOryx\Shared\QrCodeGenerator\QrCodeGeneratorConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

/**
 * Class QrCodeGeneratorConfig
 *
 * @package FondOfOryx\Service\QrCodeGenerator
 */
class QrCodeGeneratorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_FORMAT, QrCodeGeneratorConstants::QR_CODE_FORMAT_DEFAULT);
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_ENCODING, QrCodeGeneratorConstants::QR_CODE_ENCODING_DEFAULT);
    }

    /**
     * @return int
     */
    public function getErrorCorrectionLevel(): int
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_ERROR_CORRECTION_LEVEL, QrCodeGeneratorConstants::QR_CODE_ERROR_CORRECTION_LEVEL_DEFAULT);
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_SIZE, QrCodeGeneratorConstants::QR_CODE_SIZE_DEFAULT);
    }

    /**
     * @return int
     */
    public function getMargin(): int
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_MARGIN, QrCodeGeneratorConstants::QR_CODE_MARGIN_DEFAULT);
    }

    /**
     * @return int
     */
    public function getRoundedBlockSizeMode(): int
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_ROUNDED_BLOCK_SIZE_MODE, QrCodeGeneratorConstants::QR_CODE_ROUNDED_BLOCK_SIZE_MODE_DEFAULT);
    }

    /**
     * @return array
     */
    public function getForegroundColor(): array
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_FOREGROUND_COLOR, QrCodeGeneratorConstants::QR_CODE_FOREGROUND_COLOR_DEFAULT);
    }

    /**
     * @return array
     */
    public function getBackgroundColor(): array
    {
        return $this->get(QrCodeGeneratorConstants::QR_CODE_BACKGROUND_COLOR, QrCodeGeneratorConstants::QR_CODE_BACKGROUND_COLOR_DEFAULT);
    }
}
