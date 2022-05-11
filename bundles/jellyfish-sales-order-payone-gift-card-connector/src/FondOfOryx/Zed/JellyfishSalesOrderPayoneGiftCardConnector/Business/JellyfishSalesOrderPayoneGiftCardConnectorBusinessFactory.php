<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface getEntityManager()
 */
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
        return new ProportionalGiftCardValueManager($this->getEntityManager());
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
}
