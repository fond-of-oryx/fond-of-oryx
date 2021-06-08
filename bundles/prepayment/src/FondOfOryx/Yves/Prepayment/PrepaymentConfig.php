<?php

namespace FondOfOryx\Yves\Prepayment;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class PrepaymentConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getIban()
    {
        return $this->get(PrepaymentConstants::IBAN, '');
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->get(PrepaymentConstants::BIC, '');
    }

    /**
     * @return string
     */
    public function getAccountHolder()
    {
        return $this->get(PrepaymentConstants::ACCOUNT_HOLDER, '');
    }

    /**
     * @return string
     */
    public function getCustomText()
    {
        return $this->get(PrepaymentConstants::CUSTOM_TEXT, '');
    }
}
