<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Address\AddressReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Address\AddressReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\PlaceOrderProcessor;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\PlaceOrderProcessorInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidator;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidatorInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToPaymentFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\PlaceOrderProcessorInterface
     */
    public function createPlaceOrderProcessor(): PlaceOrderProcessorInterface
    {
        return new PlaceOrderProcessor(
            $this->getSplittableCheckoutFacade(),
            $this->getCalculationFacade(),
            $this->createSplittableCheckoutValidator(),
            $this->getQuoteMapperPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Validator\SplittableCheckoutValidatorInterface
     */
    public function createSplittableCheckoutValidator(): SplittableCheckoutValidatorInterface
    {
        return new SplittableCheckoutValidator(
            $this->createQuoteReader(),
            $this->getSplittableCheckoutDataValidatorPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote\QuoteReaderInterface
     */
    public function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader($this->getCartsRestApiFacade());
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Address\AddressReaderInterface
     */
    public function createAddressReader(): AddressReaderInterface
    {
        return new AddressReader($this->getCustomerFacade());
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface
     */
    public function getCartFacade(): SplittableCheckoutRestApiToCartFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_CART);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface
     */
    public function getCartsRestApiFacade(): SplittableCheckoutRestApiToCartsRestApiFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_CARTS_REST_API);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCheckoutFacadeInterface
     */
    public function getSplittableCheckoutFacade(): SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiToCustomerFacadeInterface
     */
    public function getCustomerFacade(): SplittableCheckoutRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToPaymentFacadeInterface
     */
    public function getPaymentFacade(): SplittableCheckoutRestApiToPaymentFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_PAYMENT);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface
     */
    public function getQuoteFacade(): SplittableCheckoutRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToShipmentFacadeInterface
     */
    public function getShipmentFacade(): SplittableCheckoutRestApiToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_SHIPMENT);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeInterface
     */
    public function getCalculationFacade(): SplittableCheckoutRestApiToCalculationFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_CALCULATION);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[]
     */
    public function getQuoteMapperPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_MAPPER);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutDataValidatorPluginInterface[]
     */
    public function getSplittableCheckoutDataValidatorPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_SPLITTABLE_CHECKOUT_DATA_VALIDATOR);
    }
}
