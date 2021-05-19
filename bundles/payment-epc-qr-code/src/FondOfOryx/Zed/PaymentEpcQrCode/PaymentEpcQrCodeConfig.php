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
    public function getEpcDataIban(): string
    {
        return str_replace(' ', '', $this->get(PrepaymentConstants::IBAN));
    }

    /**
     * @return string
     */
    public function getEpcDataReceiverName(): string
    {
        return $this->get(PrepaymentConstants::ACCOUNT_HOLDER);
    }

    /**
     * @return string
     */
    public function getEpcDataBic(): string
    {
        return $this->get(PrepaymentConstants::BIC);
    }

    /**
     * @return string
     */
    public function getEpcDataVersion(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_DATA_VERSION, '002');
    }

    /**
     * @return string
     */
    public function getEpcDataServiceTag(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_DATA_SERVICE_TAG, 'BCD');
    }

    /**
     * @return string
     */
    public function getEpcDataEncoding(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_DATA_ENCODING, 'UTF-8');
    }

    /**
     * @return string
     */
    public function getEpcDataType(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_DATA_TYPE, 'SCT');
    }

    /**
     * @return string
     */
    public function getEpcDataPurpose(): string
    {
        return $this->get(PaymentEpcQrCodeConstants::EPC_QR_CODE_DATA_PURPOSE, '');
    }
}
