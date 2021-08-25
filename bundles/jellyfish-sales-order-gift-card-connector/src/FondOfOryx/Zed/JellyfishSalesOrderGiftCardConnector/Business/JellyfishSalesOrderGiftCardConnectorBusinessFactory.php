<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    public function createJellyfishOrderItemExpander(): JellyfishOrderItemExpanderInterface
    {
        return new JellyfishOrderItemExpander();
    }
}
