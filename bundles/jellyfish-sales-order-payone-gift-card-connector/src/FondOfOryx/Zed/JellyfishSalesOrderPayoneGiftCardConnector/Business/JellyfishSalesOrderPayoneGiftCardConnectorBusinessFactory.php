<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpander;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReader;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface
     */
    public function createProportionalGiftCardValueCalculator(): ProportionalGiftCardAmountCalculatorInterface
    {
        return new ProportionalGiftCardAmountCalculator($this->getPayoneService(), $this->getSalesFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface
     */
    public function createProportionalGiftCardValueManager(): ProportionalGiftCardValueManagerInterface
    {
        return new ProportionalGiftCardValueManager($this->getGiftCardProportionalValueFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
     */
    protected function getSalesFacade(): JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface
     */
    protected function getPayoneService(): JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::SERVICE_PAYONE);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpanderInterface
     */
    public function createOrderItemsExpander(): OrderItemsExpanderInterface
    {
        return new OrderItemsExpander($this->createGiftCardAmountReader());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface
     */
    protected function createGiftCardAmountReader(): GiftCardAmountReaderInterface
    {
        return new GiftCardAmountReader($this->getGiftCardProportionalValueFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected function getGiftCardProportionalValueFacade(): JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR);
    }
}
