<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business;

use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculator;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidator;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig getConfig()
 */
class GiftCardProportionalValuePayoneConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface
     */
    public function createProportionalGiftCardCalculator(): ProportionalGiftCardCalculatorInterface
    {
        return new ProportionalGiftCardCalculator($this->getPayoneService(), $this->getSalesFacade());
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface
     */
    public function createIsPayonePaymentValidator(): IsPayonePaymentValidatorInterface
    {
        return new IsPayonePaymentValidator($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface
     */
    protected function getPayoneService(): GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface
    {
        return $this->getProvidedDependency(GiftCardProportionalValuePayoneConnectorDependencyProvider::SERVICE_PAYONE);
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface
     */
    protected function getSalesFacade(): GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface
    {
        return $this->getProvidedDependency(GiftCardProportionalValuePayoneConnectorDependencyProvider::FACADE_SALES);
    }
}
