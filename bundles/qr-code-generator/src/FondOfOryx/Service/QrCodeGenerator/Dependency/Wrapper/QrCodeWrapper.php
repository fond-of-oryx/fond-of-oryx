<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelQuartile;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\QrCodeInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeEnlarge;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeNone;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeShrink;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Exception;
use FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig;
use Generated\Shared\Transfer\QrCodeColorConfigurationTransfer;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class QrCodeWrapper implements QrCodeWrapperInterface
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface
     */
    protected $writerCollection;

    /**
     * @var \Closure[]
     */
    protected $errorLevel;

    /**
     * @var \Closure[]
     */
    protected $roundBlockSizeMode;

    /**
     * @param \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface $writerCollection
     * @param \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig $config
     */
    public function __construct(WriterCollectionInterface $writerCollection, QrCodeGeneratorConfig $config)
    {
        $this->config = $config;
        $this->writerCollection = $writerCollection;
        $this->initErrorLevel();
        $this->initRoundBlockSizeModes();
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     */
    public function createQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): ResultInterface
    {
        $writer = $this->writerCollection->get($this->getStringValue($this->config->getFormat(), $qrCodeGeneratorRequestTransfer->getFormat()));

        return $writer->write($this->buildQrCode($qrCodeGeneratorRequestTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \Endroid\QrCode\QrCodeInterface
     */
    protected function buildQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): QrCodeInterface
    {
        $qrCode = QrCode::create($qrCodeGeneratorRequestTransfer->getData());

        return $qrCode
            ->setEncoding(new Encoding($this->getStringValue($this->config->getEncoding(), $qrCodeGeneratorRequestTransfer->getEncoding())))
            ->setMargin($this->getIntValue($this->config->getMargin(), $qrCodeGeneratorRequestTransfer->getMargin()))
            ->setErrorCorrectionLevel($this->getErrorLevel($qrCodeGeneratorRequestTransfer))
            ->setRoundBlockSizeMode($this->getRoundBlockSizeMode($qrCodeGeneratorRequestTransfer))
            ->setForegroundColor($this->createColor($this->getColor($this->config->getForegroundColor(), $qrCodeGeneratorRequestTransfer->getForegroundColor())))
            ->setBackgroundColor($this->createColor($this->getColor($this->config->getBackgroundColor(), $qrCodeGeneratorRequestTransfer->getBackgroundColor())))
            ->setSize($this->getIntValue($this->config->getSize(), $qrCodeGeneratorRequestTransfer->getSize()));
    }

    /**
     * @param string $fallback
     * @param string|null $preferred
     *
     * @return string
     */
    protected function getStringValue(string $fallback, ?string $preferred = null): string
    {
        return $preferred ?? $fallback;
    }

    /**
     * @param int $fallback
     * @param int|null $preferred
     *
     * @return int
     */
    protected function getIntValue(int $fallback, ?int $preferred = null): int
    {
        return $preferred ?? $fallback;
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelInterface
     */
    protected function getErrorLevel(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): ErrorCorrectionLevelInterface
    {
        $errorLevelCode = $this->getIntValue($this->config->getErrorCorrectionLevel(), $qrCodeGeneratorRequestTransfer->getErrorCorrectionLevel());

        if (array_key_exists($errorLevelCode, $this->errorLevel)) {
            return $this->errorLevel[$errorLevelCode]();
        }

        throw new Exception(sprintf(
            'Error level %s not known. Please chose from 0 to 3 (low, medium, high, quartile)',
            $errorLevelCode
        ));
    }

    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface
     */
    protected function getRoundBlockSizeMode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer): RoundBlockSizeModeInterface
    {
        $roundedBlockSizeModeCode = $this->getIntValue($this->config->getRoundedBlockSizeMode(), $qrCodeGeneratorRequestTransfer->getRoundedBlockSizeMode());

        if (array_key_exists($roundedBlockSizeModeCode, $this->roundBlockSizeMode)) {
            return $this->roundBlockSizeMode[$roundedBlockSizeModeCode]();
        }

        throw new Exception(sprintf(
            'Mode %s not known. Please chose from 0 to 3 (none, margin, large, shrink)',
            $roundedBlockSizeModeCode
        ));
    }

    /**
     * @return void
     */
    protected function initErrorLevel(): void
    {
        $this->errorLevel = [
            0 => static function () {
                return new ErrorCorrectionLevelLow();
            },
            1 => static function () {
                return new ErrorCorrectionLevelMedium();
            },
            2 => static function () {
                return new ErrorCorrectionLevelHigh();
            },
            3 => static function () {
                return new ErrorCorrectionLevelQuartile();
            },
        ];
    }

    /**
     * @return void
     */
    protected function initRoundBlockSizeModes(): void
    {
        $this->roundBlockSizeMode = [
            0 => static function () {
                return new RoundBlockSizeModeNone();
            },
            1 => static function () {
                return new RoundBlockSizeModeMargin();
            },
            2 => static function () {
                return new RoundBlockSizeModeEnlarge();
            },
            3 => static function () {
                return new RoundBlockSizeModeShrink();
            },
        ];
    }

    /**
     * @param array $configColor
     * @param \Generated\Shared\Transfer\QrCodeColorConfigurationTransfer|null $colorConfigurationTransfer
     *
     * @return array
     */
    protected function getColor(
        array $configColor,
        ?QrCodeColorConfigurationTransfer $colorConfigurationTransfer = null
    ): array {
        $color = $configColor;
        if ($colorConfigurationTransfer !== null) {
            $color = [
                $colorConfigurationTransfer->getRed(),
                $colorConfigurationTransfer->getGreen(),
                $colorConfigurationTransfer->getBlue(),
            ];
        }

        return $color;
    }

    /**
     * @param array $colorValue
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\Color\Color
     */
    protected function createColor(array $colorValue): Color
    {
        if (count($colorValue) !== 3) {
            throw new Exception('Missing color value! Array in format [255, 255, 255] needed. Possible values 0 - 255');
        }

        foreach ($colorValue as $value) {
            if (is_numeric($value) === false || $value > 255 || $value < 0) {
                throw new Exception(vsprintf('Color mismatch! Red, green, blue (0 - 255) required. Given red: %s, green: %s, blue: %s', $colorValue));
            }
        }
        [$red, $green, $blue] = $colorValue;

        return new Color($red, $green, $blue);
    }
}
