<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpander;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpanderInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Generator\ReturnLabelGenerator;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Generator\ReturnLabelGeneratorInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapper;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapper;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface getClient()
 */
class ReturnLabelsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Generator\ReturnLabelGeneratorInterface
     */
    public function createReturnLabelGenerator(): ReturnLabelGeneratorInterface
    {
        return new ReturnLabelGenerator(
            $this->createRestReturnLabelRequestMapper(),
            $this->createRestReturnLabelRequestExpander(),
            $this->createRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapperInterface
     */
    protected function createRestReturnLabelRequestMapper(): RestReturnLabelRequestMapperInterface
    {
        return new RestReturnLabelRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpanderInterface
     */
    protected function createRestReturnLabelRequestExpander(): RestReturnLabelRequestExpanderInterface
    {
        return new RestReturnLabelRequestExpander();
    }

    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestReturnLabelMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface
     */
    protected function createRestReturnLabelMapper(): RestReturnLabelMapperInterface
    {
        return new RestReturnLabelMapper();
    }
}
