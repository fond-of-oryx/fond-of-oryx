<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Permission;

use FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Shared\CompaniesRestApi\CompaniesRestApiConstants;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PermissionChecker implements PermissionCheckerInterface
{
    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface
     */
    protected $permissionClient;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $requestMapper;

    /**
     * @param \FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface $permissionClient
     * @param \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface $permissionRequestMapper
     */
    public function __construct(
        CompaniesRestApiToCompaniesRestApiPermissionInterface $permissionClient,
        PermissionRequestMapperInterface $permissionRequestMapper
    ) {
        $this->permissionClient = $permissionClient;
        $this->requestMapper = $permissionRequestMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return bool
     */
    public function can(RestRequestInterface $restRequest): bool
    {
        $request = $this->requestMapper->fromRestRequest($restRequest)->setPermissionKey(CompaniesRestApiConstants::PERMISSION_KEY);

        return $this->permissionClient->hasPermissionToDeleteCompany($request);
    }
}
