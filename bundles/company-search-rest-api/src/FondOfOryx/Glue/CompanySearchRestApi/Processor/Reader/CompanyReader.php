<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClientInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapperInterface
     */
    protected $companyListMapper;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapperInterface $companyListMapper
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyListMapperInterface $companyListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanySearchRestApiClientInterface $client
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
        $companyListTransfer = $this->companyListMapper->fromRestRequest($restRequest);

        if ($companyListTransfer->getCustomerReference() === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        return $this->restResponseBuilder->buildCompanySearchRestResponse(
            $this->client->searchCompanies($companyListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
