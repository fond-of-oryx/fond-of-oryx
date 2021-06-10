<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilder;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilder;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpander;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapper;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReader;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReaderInterface;
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
            $this->createRestSplittableCheckoutRequestMapper(),
            $this->createRestSplittableCheckoutRequestExpander(),
            $this->createSplittableCheckoutRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReaderInterface
     */
    public function createSplittableTotalsReader(): SplittableTotalsReaderInterface
    {
        return new SplittableTotalsReader(
            $this->createRestSplittableCheckoutRequestMapper(),
            $this->createRestSplittableCheckoutRequestExpander(),
            $this->createSplittableTotalsRestResponseBuilder(),
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
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface
     */
    protected function createSplittableCheckoutRestResponseBuilder(): SplittableCheckoutRestResponseBuilderInterface
    {
        return new SplittableCheckoutRestResponseBuilder(
            $this->createRestSplittableCheckoutMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface
     */
    protected function createSplittableTotalsRestResponseBuilder(): SplittableTotalsRestResponseBuilderInterface
    {
        return new SplittableTotalsRestResponseBuilder(
            $this->createRestSplittableTotalsMapper(),
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

    /***
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface
     */
    protected function createRestSplittableTotalsMapper(): RestSplittableTotalsMapperInterface
    {
        return new RestSplittableTotalsMapper();
    }
}
