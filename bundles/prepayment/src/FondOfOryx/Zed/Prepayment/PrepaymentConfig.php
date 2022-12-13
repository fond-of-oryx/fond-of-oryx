<?php

namespace FondOfOryx\Zed\Prepayment;

use Exception;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PrepaymentConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getIban(): ?string
    {
        try {
            return $this->get(PrepaymentConstants::IBAN);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getBic(): ?string
    {
        try {
            return $this->get(PrepaymentConstants::BIC);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getAccountHolder(): ?string
    {
        try {
            return $this->get(PrepaymentConstants::ACCOUNT_HOLDER);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getBank(): ?string
    {
        try {
            return $this->get(PrepaymentConstants::CUSTOM_TEXT);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return array
     */
    public function getForceInvalidMailAddresses(): array
    {
        return array_map('strtolower', $this->get(PrepaymentConstants::MAIL_ADDRESSES_FOR_INVALID_TEST, []));
    }
}
