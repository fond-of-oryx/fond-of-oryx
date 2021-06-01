<?php

namespace FondOfOryx\Zed\Prepayment;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PrepaymentConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getIban(): ?string
    {
        return $this->get(PrepaymentConstants::IBAN);
    }

    /**
     * @return string|null
     */
    public function getBic(): ?string
    {
        return $this->get(PrepaymentConstants::BIC);
    }

    /**
     * @return string|null
     */
    public function getAccountHolder(): ?string
    {
        return $this->get(PrepaymentConstants::ACCOUNT_HOLDER);
    }

    /**
     * @return string|null
     */
    public function getBank(): ?string
    {
        return $this->get(PrepaymentConstants::CUSTOM_TEXT);
    }
}
