<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClientInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
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
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected CustomerReferenceFilterInterface $customerReferenceFilter;

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
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyListMapperInterface $companyListMapper,
        CustomerReferenceFilterInterface $customerReferenceFilter,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanySearchRestApiClientInterface $client
    ) {
        $this->companyListMapper = $companyListMapper;
        $this->customerReferenceFilter = $customerReferenceFilter;
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
        $customerReference = $this->customerReferenceFilter->filterFromRestRequest($restRequest);

        if ($customerReference === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        $companyListTransfer = $this->companyListMapper->fromRestRequest($restRequest);

        return $this->restResponseBuilder->buildCompanySearchRestResponse(
            $this->client->searchCompanies($companyListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
