<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpander;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessor;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig getConfig()
 * @method \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface getClient()
 */
class SplittableCheckoutRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessorInterface
     */
    public function createSplittableCheckoutProcessor(): SplittableCheckoutProcessorInterface
    {
        return new SplittableCheckoutProcessor(
            $this->createRestSplittableCheckoutRequestExpander(),
            $this->createRestSplittableCheckoutRequestMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface
     */
    protected function createRestSplittableCheckoutRequestMapper(): RestSplittableCheckoutRequestMapperInterface
    {
        return new RestSplittableCheckoutRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface
     */
    protected function createRestSplittableCheckoutRequestExpander(): RestSplittableCheckoutRequestExpanderInterface
    {
        return new RestSplittableCheckoutRequestExpander($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestSplittableCheckoutMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface
     */
    protected function createRestSplittableCheckoutMapper(): RestSplittableCheckoutMapperInterface
    {
        return new RestSplittableCheckoutMapper();
    }
}
