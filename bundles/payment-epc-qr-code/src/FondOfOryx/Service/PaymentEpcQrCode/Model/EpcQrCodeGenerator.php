<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface;
use FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface;
use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;
use Generated\Shared\Transfer\QrCodeColorConfigurationTransfer;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class EpcQrCodeGenerator implements EpcQrCodeGeneratorInterface
{
    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface
     */
    protected $dataBuilder;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface
     */
    protected $qrCodeGeneratorService;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface $epcDataBuilder
     * @param \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface $qrCodeGeneratorService
     * @param \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig $config
     */
    public function __construct(
        EpcDataBuilderInterface $epcDataBuilder,
        PaymentEpcQrCodeToQrCodeGeneratorServiceInterface $qrCodeGeneratorService,
        PaymentEpcQrCodeConfig $config
    ) {
        $this->dataBuilder = $epcDataBuilder;
        $this->qrCodeGeneratorService = $qrCodeGeneratorService;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function generateEpcQrCode(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): QrCodeInterface
    {
        $dataString = $this->dataBuilder->fromTransfer($paymentEpcQrCodeRequestTransfer);
        $requestTransfer = $this->createQrCodeRequest()->setData($dataString);

        return $this->qrCodeGeneratorService->createQrCode($requestTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer
     */
    protected function createQrCodeRequest(): QrCodeGeneratorRequestTransfer
    {
        $requestTransfer = new QrCodeGeneratorRequestTransfer();

        return $requestTransfer
            ->setEncoding($this->config->getEncoding())
            ->setBackgroundColor($this->createColorConfigTransfer($this->config->getForegroundColor()))
            ->setForegroundColor($this->createColorConfigTransfer($this->config->getBackgroundColor()))
            ->setMargin($this->config->getMargin())
            ->setSize($this->config->getSize())
            ->setErrorCorrectionLevel($this->config->getErrorCorrectionLevel())
            ->setFormat($this->config->getFormat())
            ->setRoundedBlockSizeMode($this->config->getRoundedBlockSizeMode());
    }

    /**
     * @param array|null $colorData
     *
     * @return \Generated\Shared\Transfer\QrCodeColorConfigurationTransfer|null
     */
    protected function createColorConfigTransfer(?array $colorData): ?QrCodeColorConfigurationTransfer
    {
        if (empty($colorData) || count($colorData) !== 3) {
            return null;
        }
        [$red, $green, $blue] = $colorData;

        return (new QrCodeColorConfigurationTransfer())
            ->setRed($red)
            ->setGreen($green)
            ->setBlue($blue);
    }
}
