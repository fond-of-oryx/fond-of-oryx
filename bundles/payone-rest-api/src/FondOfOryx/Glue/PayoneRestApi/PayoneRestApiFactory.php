<?php

namespace FondOfOryx\Glue\PayoneRestApi;

use FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientInterface;
use FondOfOryx\Glue\PayoneRestApi\Handler\PayoneHandler;
use FondOfOryx\Glue\PayoneRestApi\Handler\PayoneHandlerInterface;
use FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\PayoneRestApi\Processor\CreditCardCheckProcessor;
use FondOfOryx\Glue\PayoneRestApi\Processor\CreditCardCheckProcessorInterface;
use FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCheckoutDataResponseAttributesMapper;
use FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCheckoutDataResponseAttributesMapperInterface;
use FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapper;
use FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class PayoneRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Processor\CreditCardCheckProcessorInterface
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCreditCardCheckProcessor(): CreditCardCheckProcessorInterface{
        return new CreditCardCheckProcessor($this->getPayoneRestApiToPayoneClient(), $this->createRestResponseBuilder());
    }

    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createRestCreditCardDataResponseAttributesMapper());
    }

    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Handler\PayoneHandlerInterface
     */
    public function createPayoneHandler(): PayoneHandlerInterface
    {
        return new PayoneHandler();
    }

    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapperInterface
     */
    public function createRestCreditCardDataResponseAttributesMapper(): RestCreditCardDataResponseAttributesMapperInterface
    {
        return new RestCreditCardDataResponseAttributesMapper();
    }

    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCheckoutDataResponseAttributesMapperInterface
     */
    public function createRestCheckoutDataResponseAttributesMapper(): RestCheckoutDataResponseAttributesMapperInterface
    {
        return new RestCheckoutDataResponseAttributesMapper();
    }

    /**
     * @return \FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientInterface
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getPayoneRestApiToPayoneClient(): PayoneRestApiToPayoneClientInterface
    {
        return $this->getProvidedDependency(PayoneRestApiDependencyProvider::CLIENT_PAYONE);
    }
}
