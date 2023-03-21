<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter;

use FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyDeleter implements CompanyDeleterInterface
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface
     */
    protected $companyMapper;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $responseBuilder;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface $client
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface $companyMapper
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     */
    public function __construct(
        CompaniesRestApiClientInterface $client,
        CompanyMapperInterface $companyMapper,
        RestResponseBuilderInterface $responseBuilder
    ) {
        $this->client = $client;
        $this->companyMapper = $companyMapper;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface
    {
        $companyTransfer = $this->client->deleteCompany($this->companyMapper->fromRestRequest($restRequest));

        return $this->responseBuilder->buildCompanyDeleterRestResponse($companyTransfer);
    }
}
