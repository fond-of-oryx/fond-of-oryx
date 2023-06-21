<?php

namespace FondOfOryx\Glue\CountriesRestApi;

use FondOfOryx\Glue\CountriesRestApi\Processor\Expander\CountryByCheckoutDataExpander;
use FondOfOryx\Glue\CountriesRestApi\Processor\Expander\CountryByCheckoutDataExpanderInterface;
use FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapper;
use FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapperInterface;
use FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilder;
use FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CountriesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CountriesRestApi\Processor\Expander\CountryByCheckoutDataExpanderInterface
     */
    public function createCountryByCheckoutDataExpander(): CountryByCheckoutDataExpanderInterface
    {
        return new CountryByCheckoutDataExpander($this->createCountryRestResponseBuilder());
    }

    /**
     * @return \FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilderInterface
     */
    public function createCountryRestResponseBuilder(): CountryRestResponseBuilderInterface
    {
        return new CountryRestResponseBuilder($this->getResourceBuilder(), $this->createCountryMapper());
    }

    /**
     * @return \FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapperInterface
     */
    protected function createCountryMapper(): CountryMapperInterface
    {
        return new CountryMapper($this->getConfig());
    }
}
