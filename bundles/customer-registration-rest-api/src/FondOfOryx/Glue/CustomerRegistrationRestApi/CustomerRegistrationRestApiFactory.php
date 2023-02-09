<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi;

use FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessor;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapper;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\Generator as PasswordGenerator;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiError;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface getClient()
 */
class CustomerRegistrationRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface
     */
    public function createCustomerRegistrationProcessor(): CustomerRegistrationProcessorInterface
    {
        return new CustomerRegistrationProcessor(
            $this->createCustomerRegistrationResourceMapper(),
            $this->getResourceBuilder(),
            $this->createApiError(),
            $this->getCustomerClient(),
            $this->createPasswordGenerator(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface
     */
    protected function createPasswordGenerator(): GeneratorInterface
    {
        return new PasswordGenerator();
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected function createApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface
     */
    protected function createCustomerRegistrationResourceMapper(): CustomerRegistrationResourceMapperInterface
    {
        return new CustomerRegistrationResourceMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface
     */
    protected function getCustomerClient(): CustomerRegistrationRestApiToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::CLIENT_CUSTOMER);
    }
}
