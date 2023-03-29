<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi;

use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessor;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessorInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilter;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapper;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface getClient()
 */
class BusinessOnBehalfRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessorInterface
     */
    public function createBusinessOnBehalfProcessor(): BusinessOnBehalfProcessorInterface
    {
        return new BusinessOnBehalfProcessor(
            $this->createIdCustomerFilter(),
            $this->createRestBusinessOnBehalfRequestMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface
     */
    protected function createIdCustomerFilter(): IdCustomerFilterInterface
    {
        return new IdCustomerFilter();
    }

    /**
     * @return \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface
     */
    protected function createRestBusinessOnBehalfRequestMapper(): RestBusinessOnBehalfRequestMapperInterface
    {
        return new RestBusinessOnBehalfRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->getResourceBuilder(),
        );
    }
}
