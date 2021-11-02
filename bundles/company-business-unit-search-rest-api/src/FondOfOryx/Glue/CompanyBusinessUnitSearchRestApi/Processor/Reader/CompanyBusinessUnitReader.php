<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapperInterface
     */
    protected $companyBusinessUnitListMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapperInterface $companyBusinessUnitListMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyBusinessUnitListMapperInterface $companyBusinessUnitListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanyBusinessUnitSearchRestApiClientInterface $client
    ) {
        $this->companyBusinessUnitListMapper = $companyBusinessUnitListMapper;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function find(RestRequestInterface $restRequest): RestResponseInterface
    {
        $companyBusinessUnitListTransfer = $this->companyBusinessUnitListMapper->fromRestRequest($restRequest);

        if ($companyBusinessUnitListTransfer->getCustomerReference() === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        return $this->restResponseBuilder->buildCompanyBusinessUnitSearchRestResponse(
            $this->client->searchCompanyBusinessUnit($companyBusinessUnitListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
