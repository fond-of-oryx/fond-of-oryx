<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter;

use FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyCollectionMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyDeleter implements CompanyDeleterInterface
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyCollectionMapperInterface
     */
    protected $companyCollectionMapper;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface $client
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyCollectionMapperInterface $companyCollectionMapper
     */
    public function __construct(CompaniesRestApiClientInterface $client, CompanyCollectionMapperInterface $companyCollectionMapper)
    {
        $this->client = $client;
        $this->companyCollectionMapper = $companyCollectionMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface
    {
        $collection = $this->companyCollectionMapper->fromRestRequest($restRequest);
        $this->client->deleteCompanies($collection);

        //ToDo add response
    }
}
