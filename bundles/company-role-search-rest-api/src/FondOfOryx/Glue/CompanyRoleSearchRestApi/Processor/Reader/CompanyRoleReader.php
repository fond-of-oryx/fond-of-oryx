<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyRoleReader implements CompanyRoleReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface
     */
    protected $companyRoleListMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface $companyRoleListMapper
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyRoleListMapperInterface $companyRoleListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanyRoleSearchRestApiClientInterface $client
    ) {
        $this->companyRoleListMapper = $companyRoleListMapper;
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
        $companyRoleListTransfer = $this->companyRoleListMapper->fromRestRequest($restRequest);

        if ($companyRoleListTransfer->getCustomerReference() === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        return $this->restResponseBuilder->buildCompanyRoleSearchRestResponse(
            $this->client->searchCompanyRoles($companyRoleListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
