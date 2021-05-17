<?php

namespace FondOfOryx\Zed\PaymentEpcQrCode;

use FondOfOryx\Shared\PaymentEpcQrCode\PaymentEpcQrCodeConstants;
use FondOfSpryker\Shared\Prepayment\PrepaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentEpcQrCodeConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getIban(): string
    {
        return str_replace(' ', '', $this->get(PrepaymentConstants::IBAN));
    }

    /**
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->get(PrepaymentConstants::ACCOUNT_HOLDER);
    }

    /**
     * @return string
     */
    public function getBic(): string
    {
        return $this->get(PrepaymentConstants::BIC);
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_VERSION, '002');
    }

    /**
     * @return string
     */
    public function getServiceTag(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_SERVICE_TAG, 'BCD');
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_ENCODING, 'UTF-8');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_TYPE, 'SCT');
    }

    /**
     * @return string
     */
    public function getPurpose(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_PURPOSE, '');
    }
}
