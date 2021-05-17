<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper;

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
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\WriterInterface;
use Exception;
use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class QrCodeWrapper implements QrCodeWrapperInterface
{
    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig
     */
    protected $config;

    /**
     * @var \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelInterface[]
     */
    protected $errorLevel;

    /**
     * @var \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface[]
     */
    protected $roundBlockSizeMode;

    /**
     * @param \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig $config
     */
    public function __construct(PaymentEpcQrCodeConfig $config)
    {
        $this->config = $config;
        $this->initErrorLevel();
        $this->initRoundBlockSizeModes();
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     */
    public function createQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): ResultInterface
    {
        return $this->createSvgWriter()->write($this->initQrCode($paymentEpcQrCodeRequestTransfer));
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createSvgWriter(): WriterInterface
    {
        return new SvgWriter();
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\QrCodeInterface
     */
    protected function initQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface
    {
        $qrCode = QrCode::create($this->convertTransferToData($paymentEpcQrCodeRequestTransfer));

        return $qrCode
            ->setEncoding(new Encoding($this->config->getEncoding()))
            ->setMargin($this->config->getSize())
            ->setErrorCorrectionLevel($this->getErrorLevel($this->config->getErrorCorrectionLevel()))
            ->setRoundBlockSizeMode($this->getRoundBlockSizeMode($this->config->getRoundedBlockSizeMode()))
            ->setForegroundColor($this->createColor($this->config->getForegroundColor()))
            ->setBackgroundColor($this->createColor($this->config->getBackgroundColor()))
            ->setSize($this->config->getSize());
    }

    /**
     * @param int $errorLevelCode
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelInterface
     */
    protected function getErrorLevel(int $errorLevelCode): ErrorCorrectionLevelInterface
    {
        if (array_key_exists($errorLevelCode, $this->errorLevel)) {
            return $this->errorLevel[$errorLevelCode];
        }

        throw new Exception(sprintf(
            'Error level %s not known. Please chose from 0 to 3 (low, medium, high, quartile)',
            $errorLevelCode
        ));
    }

    /**
     * @param int $roundedBlockSizeModeCode
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface
     */
    protected function getRoundBlockSizeMode(int $roundedBlockSizeModeCode): RoundBlockSizeModeInterface
    {
        if (array_key_exists($roundedBlockSizeModeCode, $this->roundBlockSizeMode)) {
            return $this->roundBlockSizeMode[$roundedBlockSizeModeCode];
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
            0 => new ErrorCorrectionLevelLow(),
            1 => new ErrorCorrectionLevelMedium(),
            2 => new ErrorCorrectionLevelHigh(),
            3 => new ErrorCorrectionLevelQuartile(),
        ];
    }

    /**
     * @return void
     */
    protected function initRoundBlockSizeModes(): void
    {
        $this->roundBlockSizeMode = [
            0 => new RoundBlockSizeModeNone(),
            1 => new RoundBlockSizeModeMargin(),
            2 => new RoundBlockSizeModeEnlarge(),
            3 => new RoundBlockSizeModeShrink(),
        ];
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
            throw new Exception('Color value mismatch!');
        }

        foreach ($colorValue as $value) {
            if (is_numeric($value) === false || $value > 255 || $value < 0) {
                throw new Exception();
            }
        }
        [$red, $green, $blue] = $colorValue;

        return new Color($red, $green, $blue);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @throws \Exception
     *
     * @return string
     */
    protected function convertTransferToData(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): string
    {
        $paymentEpcQrCodeRequestTransfer
            ->requireServiceTag()
            ->requireVersion()
            ->requireEncoding()
            ->requireType()
            ->requireBic()
            ->requireBank()
            ->requireIban()
            ->requireAmount();

        $usage = $paymentEpcQrCodeRequestTransfer->getUsage() ?? '';
        $reference = $paymentEpcQrCodeRequestTransfer->getReference() ?? '';
        $purpose = $paymentEpcQrCodeRequestTransfer->getPurpose() ?? '';

        if (empty($usage) && empty($reference)) {
            throw new Exception(sprintf(
                'One of "Reference(%s)" or "Purpose(%s)" must be null!',
                $paymentEpcQrCodeRequestTransfer->getReference(),
                $paymentEpcQrCodeRequestTransfer->getUsage()
            ));
        }

        $dataString = $paymentEpcQrCodeRequestTransfer->getServiceTag();
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getVersion());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getEncoding());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getType());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getBic());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getBank());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getIban());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getAmount());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->$purpose());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->$reference());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->$usage());

        return $this->appendStringAsNewLine($dataString, '');
    }

    /**
     * @param string $string
     * @param string $stringToAppend
     *
     * @return string
     */
    protected function appendStringAsNewLine(string $string, string $stringToAppend): string
    {
        return sprintf('%s%s%s', $string, PHP_EOL, $stringToAppend);
    }
}
