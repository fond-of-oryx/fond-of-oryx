<?php

namespace FondOfOryx\Glue\CountriesRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\RestCheckoutDataTransfer;

interface CountryRestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutDataTransfer $restCheckoutDataTransfer
     *
     * @return array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>
     */
    public function createRestCountriesResources(RestCheckoutDataTransfer $restCheckoutDataTransfer): array;
}
