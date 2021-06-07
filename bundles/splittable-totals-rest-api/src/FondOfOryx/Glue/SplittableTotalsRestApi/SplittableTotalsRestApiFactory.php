<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi;

use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpander;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsMapper;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapper;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReader;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig getConfig()
 * @method \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface getClient()
 */
class SplittableTotalsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReaderInterface
     */
    public function createRestSplittableTotalsReader(): RestSplittableTotalsReaderInterface
    {
        return new RestSplittableTotalsReader(
            $this->createRestSplittableTotalsRequestMapper(),
            $this->createRestSplittableTotalsRequestExpander(),
            $this->createRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface
     */
    protected function createRestSplittableTotalsRequestMapper(): RestSplittableTotalsRequestMapperInterface
    {
        return new RestSplittableTotalsRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface
     */
    protected function createRestSplittableTotalsRequestExpander(): RestSplittableTotalsRequestExpanderInterface
    {
        return new RestSplittableTotalsRequestExpander($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestSplittableTotalsMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface
     */
    protected function createRestSplittableTotalsMapper(): RestSplittableTotalsMapperInterface
    {
        return new RestSplittableTotalsMapper();
    }
}
