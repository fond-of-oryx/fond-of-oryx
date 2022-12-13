<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo;

use FondOfOryx\Shared\PrepaymentCreditMemo\PrepaymentCreditMemoConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PrepaymentCreditMemoConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getForceInvalidMailAddresses(): array
    {
        return array_map('strtolower', $this->get(PrepaymentCreditMemoConstants::MAIL_ADDRESSES_FOR_INVALID_TEST, []));
    }
}
