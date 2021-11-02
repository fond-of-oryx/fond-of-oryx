<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapperInterface
     */
    protected $companyListMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapperInterface $companyListMapper
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyUserListMapperInterface $companyListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanyUserSearchRestApiClientInterface $client
    ) {
        $this->companyListMapper = $companyListMapper;
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
        $companyUserListTransfer = $this->companyListMapper->fromRestRequest($restRequest);

        if ($companyUserListTransfer->getCustomerReference() === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        return $this->restResponseBuilder->buildCompanyUserSearchRestResponse(
            $this->client->searchCompanyUser($companyUserListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
