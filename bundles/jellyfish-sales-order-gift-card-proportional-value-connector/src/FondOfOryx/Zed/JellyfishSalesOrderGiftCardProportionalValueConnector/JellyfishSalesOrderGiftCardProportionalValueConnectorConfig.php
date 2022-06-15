<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector;

use FondOfOryx\Shared\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishSalesOrderGiftCardProportionalValueConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array<string, string>
     */
    public function getExpenseMapping(): array
    {
        return $this->get(JellyfishSalesOrderGiftCardProportionalValueConnectorConstants::EXPENSE_MAPPING, JellyfishSalesOrderGiftCardProportionalValueConnectorConstants::DEFAULT_EXPENSE_MAPPING);
    }
}
