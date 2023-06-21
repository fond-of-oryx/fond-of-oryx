<?php

namespace FondOfOryx\Glue\CountriesRestApi\Processor\Expander;

use FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilderInterface;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CountryByCheckoutDataExpander implements CountryByCheckoutDataExpanderInterface
{
    /**
     * @var \FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilderInterface
     */
    private $countryRestResponseBuilder;

    /**
     * @param \FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder\CountryRestResponseBuilderInterface $countryRestResponseBuilder
     */
    public function __construct(CountryRestResponseBuilderInterface $countryRestResponseBuilder)
    {
        $this->countryRestResponseBuilder = $countryRestResponseBuilder;
    }

    /**
     * @param array $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        foreach ($resources as $resource) {
            $restCheckoutDataTransfer = $resource->getPayload();
            if (!$restCheckoutDataTransfer instanceof RestCheckoutDataTransfer) {
                continue;
            }

            $restCountriesResources = $this->countryRestResponseBuilder
                ->createRestCountriesResources($restCheckoutDataTransfer);

            foreach ($restCountriesResources as $restCountriesResource) {
                $resource->addRelationship($restCountriesResource);
            }
        }
    }
}
