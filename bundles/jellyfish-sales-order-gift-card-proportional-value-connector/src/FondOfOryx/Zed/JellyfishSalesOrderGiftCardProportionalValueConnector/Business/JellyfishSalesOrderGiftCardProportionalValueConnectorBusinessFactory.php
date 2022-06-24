<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander\OrderItemsExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander\OrderItemsExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\GiftCardProportionalValueMapper;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReader;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig getConfig()
 */
class JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface
     */
    public function createGiftCardProportionalValueMapper(): ProportionalValueMapperInterface
    {
        return new GiftCardProportionalValueMapper($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander\OrderItemsExpanderInterface
     */
    public function createOrderItemsExpander(): OrderItemsExpanderInterface
    {
        return new OrderItemsExpander($this->createGiftCardProportionalValueReader());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReaderInterface
     */
    public function createGiftCardProportionalValueReader(): GiftCardProportionalValueReaderInterface
    {
        return new GiftCardProportionalValueReader($this->getGiftCardProportionalValueFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface
     */
    public function getGiftCardProportionalValueFacade(): JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE);
    }
}
