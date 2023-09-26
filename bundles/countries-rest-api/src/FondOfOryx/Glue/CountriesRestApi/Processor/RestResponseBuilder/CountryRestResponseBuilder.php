<?php

namespace FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder;

use FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapperInterface;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class CountryRestResponseBuilder implements CountryRestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    private $restResourceBuilder;

    /**
     * @var \FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapperInterface
     */
    private CountryMapperInterface $countryMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Glue\CountriesRestApi\Processor\Mapper\CountryMapperInterface $countryMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CountryMapperInterface $countryMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->countryMapper = $countryMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutDataTransfer $restCheckoutDataTransfer
     *
     * @return array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>
     */
    public function createRestCountriesResources(RestCheckoutDataTransfer $restCheckoutDataTransfer): array
    {
        $restResources = [];

        $restCountriesAttributesTransfers = $this->countryMapper
            ->mapRestCheckoutDataTransferToRestCountriesAttributesTransfers($restCheckoutDataTransfer);

        return $restResources;
    }
}
