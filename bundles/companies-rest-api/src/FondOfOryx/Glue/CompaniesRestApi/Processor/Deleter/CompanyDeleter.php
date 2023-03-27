<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter;

use FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface;
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
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface
     */
    protected $permissionChecker;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface $client
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface $companyMapper
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface $permissionChecker
     */
    public function __construct(
        CompaniesRestApiClientInterface $client,
        CompanyMapperInterface $companyMapper,
        RestResponseBuilderInterface $responseBuilder,
        PermissionCheckerInterface $permissionChecker
    ) {
        $this->client = $client;
        $this->companyMapper = $companyMapper;
        $this->responseBuilder = $responseBuilder;
        $this->permissionChecker = $permissionChecker;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface
    {
        if ($this->permissionChecker->can($restRequest)) {
            $companyTransfer = $this->companyMapper->fromRestRequest($restRequest);
            $companyTransfer = $this->client->deleteCompany($companyTransfer);

            return $this->responseBuilder->buildCompanyDeleterRestResponse($companyTransfer);
        }

        return $this->responseBuilder->buildCompanyDeleterMissingPermissionResponse();
    }
}
