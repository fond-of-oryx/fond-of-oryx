<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapper;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
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

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface
     */
    public function createJellyfishOrderExpander(): JellyfishOrderExpanderInterface
    {
        return new JellyfishOrderExpander($this->createGiftCardMapper());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected function createGiftCardMapper(): JellyfishOrderGiftCardMapperInterface
    {
        return new JellyfishOrderGiftCardMapper();
    }
}
