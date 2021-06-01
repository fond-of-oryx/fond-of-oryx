<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander;

use Exception;
use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface;
use FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig;
use FondOfSpryker\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class PaymentEpcQrCodeExpander implements ExpanderInterface
{
    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface
     */
    protected $qrCodeService;

    /**
     * @var \FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig
     */
    protected $config;

    protected const MAPPING_ENCODING = [
        'UTF-8' => 1,
        'ISO 8859-1' => 2,
        'ISO 8859-2' => 3,
        'ISO 8859-4' => 4,
        'ISO 8859-5' => 5,
        'ISO 8859-7' => 6,
        'ISO 8859-10' => 7,
        'ISO 8859-15' => 8,
    ];

    /**
     * @param \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface $qrCodeService
     * @param \FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig $config
     */
    public function __construct(PaymentEpcQrCodeServiceInterface $qrCodeService, PaymentEpcQrCodeConfig $config)
    {
        $this->qrCodeService = $qrCodeService;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        if ($this->isPrepayment($orderTransfer) === false) {
            return $mailTransfer;
        }

        $orderTransferFromMailTransfer = $mailTransfer->getOrder();

        $qrCode = $this->qrCodeService->createEpcQrCode($this->createQrCodeRequestFromOrder($orderTransferFromMailTransfer));
        $orderTransferFromMailTransfer->setPrepaymentEpcQrData($qrCode->getDataUri());

        return $mailTransfer->setOrder($orderTransferFromMailTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return bool
     */
    protected function isPrepayment(OrderTransfer $orderTransfer): bool
    {
        foreach ($orderTransfer->getPayments() as $paymentTransfer) {
            if ($paymentTransfer->getPaymentMethod() === PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer
     */
    protected function createQrCodeRequestFromOrder(OrderTransfer $orderTransfer): PaymentEpcQrCodeRequestTransfer
    {
        $requestTransfer = new PaymentEpcQrCodeRequestTransfer();

        return $requestTransfer
            ->setServiceTag($this->config->getEpcDataServiceTag())
            ->setVersion($this->config->getEpcDataVersion())
            ->setEncoding($this->getEncoding($this->config->getEpcDataEncoding()))
            ->setType($this->config->getEpcDataType())
            ->setBic($this->config->getEpcDataBic())
            ->setReceiverName($this->config->getEpcDataReceiverName())
            ->setIban($this->config->getEpcDataIban())
            ->setAmount($this->getMoneyAmount(
                $orderTransfer->getTotals()->getSubtotal(),
                $orderTransfer->getCurrencyIsoCode()
            ))
            ->setPurpose($this->config->getEpcDataPurpose())
            ->setReference(null)
            ->setUsage($orderTransfer->getOrderReference());
    }

    /**
     * @param string $encoding
     *
     * @throws \Exception
     *
     * @return int
     */
    protected function getEncoding(string $encoding): int
    {
        if (array_key_exists($encoding, static::MAPPING_ENCODING)) {
            return static::MAPPING_ENCODING[$encoding];
        }

        throw new Exception(sprintf(
            'Encoding %s not known! Please chose one from %s',
            $encoding,
            implode(',', array_keys(static::MAPPING_ENCODING))
        ));
    }

    /**
     * @param int $amount
     * @param string $currencyIsoCode
     *
     * @return string
     */
    protected function getMoneyAmount(int $amount, string $currencyIsoCode): string
    {
        return sprintf('%s%s', $currencyIsoCode, number_format($amount / 100, 2, '.', ''));
    }
}
