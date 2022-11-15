<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi;

use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapper;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapper;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessor;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface;
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
            $this->createRequestMapper(),
            $this->createResponseMapper(),
            $this->getResourceBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface
     */
    protected function createRequestMapper(): RequestMapperInterface
    {
        return new RequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface
     */
    protected function createResponseMapper(): ResponseMapperInterface
    {
        return new ResponseMapper();
    }
}
