<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestSplittableCheckoutErrorMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestSplittableCheckoutErrorMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpander;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilder;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessor;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessorInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidator;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface getClient()
 * @method \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig getConfig()
 */
class SplittableCheckoutRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessorInterface
     */
    public function createSplittableCheckoutProcessor(): SplittableCheckoutProcessorInterface
    {
        return new SplittableCheckoutProcessor(
            $this->getClient(),
            $this->createCheckoutRequestValidator(),
            $this->createSplittableCheckoutRequestAttributesExpander(),
            $this->createSplittableCheckoutRestResponseBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidatorInterface
     */
    public function createCheckoutRequestValidator(): SplittableCheckoutRequestValidatorInterface
    {
        return new SplittableCheckoutRequestValidator(
            $this->getSplittableCheckoutRequestValidatorPlugins(),
            $this->getSplittableCheckoutRequestAttributesValidatorPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpanderInterface
     */
    public function createSplittableCheckoutRequestAttributesExpander(): SplittableCheckoutRequestAttributesExpanderInterface
    {
        return new SplittableCheckoutRequestAttributesExpander(
            $this->createCustomerMapper(),
            $this->getConfig(),
            $this->getSplittableCheckoutRequestExpanderPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilderInterface
     */
    protected function createSplittableCheckoutRestResponseBuilder(): SplittableCheckoutRestResponseBuilderInterface
    {
        return new SplittableCheckoutRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createRestSplittableCheckoutErrorMapper()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\CustomerMapperInterface
     */
    public function createCustomerMapper(): CustomerMapperInterface
    {
        return new CustomerMapper();
    }

    public function createRestSplittableCheckoutErrorMapper(): RestSplittableCheckoutErrorMapperInterface
    {
        return new RestSplittableCheckoutErrorMapper(
            $this->getConfig(),
            $this->getGlossaryStorageClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplttableCheckoutRequestValidatorPluginInterface[]
     */
    public function getSplittableCheckoutRequestValidatorPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_VALIDATOR);
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplttableCheckoutRequestAttributesValidatorPluginInterface[]
     */
    public function getSplittableCheckoutRequestAttributesValidatorPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_ATTRIBUTES_VALIDATOR);
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestExpanderPluginInterface[]
     */
    public function getSplittableCheckoutRequestExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_EXPANDER);
    }

    /**
     * @return \Spryker\Glue\CheckoutRestApi\Dependency\Client\CheckoutRestApiToGlossaryStorageClientInterface
     */
    public function getGlossaryStorageClient(): SplittableCheckoutRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
