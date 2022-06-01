<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Validator\OnlyGiftCardPaymentValidator;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorConfig getConfig()
 */
class JellyfishSalesOrderNoPaymentGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Validator\OnlyGiftCardPaymentValidatorInterface
     */
    public function createOnlyeGiftCardPaymentValidator(): OnlyGiftCardPaymentValidatorInterface
    {
        return new OnlyGiftCardPaymentValidator(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface
     */
    public function createProportionalGiftCardValueCalculator(): ProportionalGiftCardAmountCalculatorInterface
    {
        return new ProportionalGiftCardAmountCalculator($this->getSalesFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface
     */
    public function createProportionalGiftCardValueManager(): ProportionalGiftCardValueManagerInterface
    {
        return new ProportionalGiftCardValueManager($this->getGiftCardProportionalValueFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface
     */
    protected function getSalesFacade(): JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected function getGiftCardProportionalValueFacade(): JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE);
    }
}
