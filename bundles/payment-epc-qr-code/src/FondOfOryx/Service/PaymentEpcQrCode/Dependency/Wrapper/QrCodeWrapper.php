<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelQuartile;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\QrCodeInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeEnlarge;
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

    public function __construct(PaymentEpcQrCodeConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\Writer\Result\ResultInterface
     * @throws \Exception
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
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return \Endroid\QrCode\QrCodeInterface
     * @throws \Exception
     */
    protected function initQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface
    {
        $qrCode = QrCode::create($this->convertTransferToData($paymentEpcQrCodeRequestTransfer));
        $qrCode = $this->appendDefaultErrorCorrectionLevel($qrCode);
        $qrCode = $this->appendDefaultRoundBlockSizeMode($qrCode);
        return $qrCode
            ->setEncoding(new Encoding($this->config->getEncoding()))
            ->setMargin($this->config->getSize())
            ->setForegroundColor($this->createColor($this->config->getForegroundColor()))
            ->setBackgroundColor($this->createColor($this->config->getBackgroundColor()))
            ->setSize($this->config->getSize());
    }

    /**
     * @param  \Endroid\QrCode\QrCode  $qrCode
     *
     * @return \Endroid\QrCode\QrCode
     * @throws \Exception
     */
    protected function appendDefaultErrorCorrectionLevel(QrCode $qrCode): QrCode
    {
        switch ($this->config->getErrorCorrectionLevel()) {
            case 0:
                $errorLevel = new ErrorCorrectionLevelLow();
                break;
            case 1:
                $errorLevel = new ErrorCorrectionLevelMedium();
                break;
            case 2:
                $errorLevel = new ErrorCorrectionLevelHigh();
                break;
            case 3:
                $errorLevel = new ErrorCorrectionLevelQuartile();
                break;
            default:
                throw new Exception(sprintf('Error level %s not known. Please chose from 0 to 3 (low, medium, high, quartile)',
                    $this->config->getErrorCorrectionLevel()));
        }

        return $qrCode->setErrorCorrectionLevel($errorLevel);
    }

    /**
     * @param  \Endroid\QrCode\QrCode  $qrCode
     *
     * @return \Endroid\QrCode\QrCode
     * @throws \Exception
     */
    protected function appendDefaultRoundBlockSizeMode(QrCode $qrCode): QrCode
    {
        switch ($this->config->getErrorCorrectionLevel()) {
            case 0:
                $mode = new RoundBlockSizeModeNone();
                break;
            case 1:
                $mode = new RoundBlockSizeModeMargin();
                break;
            case 2:
                $mode = new RoundBlockSizeModeEnlarge();
                break;
            case 3:
                $mode = new RoundBlockSizeModeShrink();
                break;
            default:
                throw new Exception(sprintf('Mode %s not known. Please chose from 0 to 3 (none, margin, large, shrink)',
                    $this->config->getErrorCorrectionLevel()));
        }

        return $qrCode->setRoundBlockSizeMode($mode);
    }

    /**
     * @param  array  $colorValue
     *
     * @return \Endroid\QrCode\Color\Color
     * @throws \Exception
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
     * @param  \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer  $paymentEpcQrCodeRequestTransfer
     *
     * @return string
     * @throws \Exception
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

        $usage = $paymentEpcQrCodeRequestTransfer->getUsage();
        $reference = $paymentEpcQrCodeRequestTransfer->getReference();

        if ($usage !== null && $reference !== null) {
            throw new Exception(sprintf('One of "Reference(%s)" or "Purpose(%s)" must be null!', $reference, $usage));
        }

        return
            $paymentEpcQrCodeRequestTransfer->getServiceTag().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getVersion().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getEncoding().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getType().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getBic().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getBank().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getIban().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getAmount().PHP_EOL.
            $paymentEpcQrCodeRequestTransfer->getPurpose() !== null ?? ''.PHP_EOL.
            $reference !== null ?? ''.PHP_EOL.
            $usage !== null ?? ''.PHP_EOL.
            '';
    }
}
