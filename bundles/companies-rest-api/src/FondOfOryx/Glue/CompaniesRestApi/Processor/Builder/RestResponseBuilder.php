<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Builder;

use FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyDeleterRestResponse(
        CompanyTransfer $companyTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES_REST_API,
            null,
            $companyTransfer,
        );

        return $restResponse->addResource($restResource);
    }
}
