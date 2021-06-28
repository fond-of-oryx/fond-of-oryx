<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo;

use FondOfOryx\Shared\JellyfishCreditMemo\JellyfishCreditMemoConstants;
use FondOfOryx\Zed\Jellyfish\JellyfishConfig;

class JellyfishCreditMemoConfig extends JellyfishConfig
{
    protected const DEFAULT_SALES_ORDER_ITEM_STATE_REFUNDED = 'refunded';
    
    /**
     * @return string
     */
    public function getSalesOrderItemStateRefunded()
    {
        return $this->get(
            JellyfishCreditMemoConstants::SALES_ORDER_ITEM_STATE_REFUNDED,
            static::DEFAULT_SALES_ORDER_ITEM_STATE_REFUNDED
        );
    }
}