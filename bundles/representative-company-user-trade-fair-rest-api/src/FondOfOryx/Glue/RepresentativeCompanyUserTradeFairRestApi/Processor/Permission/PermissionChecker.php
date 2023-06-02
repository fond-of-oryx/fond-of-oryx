<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConstants;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

class PermissionChecker implements PermissionCheckerInterface
{
    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface
     */
    protected $permissionClient;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $requestMapper;

    /**
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface $permissionClient
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapperInterface $permissionRequestMapper
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface $permissionClient,
        PermissionRequestMapperInterface $permissionRequestMapper
    ) {
        $this->permissionClient = $permissionClient;
        $this->requestMapper = $permissionRequestMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    public function can(RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer): bool
    {
        $request = $this->requestMapper->fromAttributesTransfer($attributesTransfer)
            ->setPermissionKey(RepresentativeCompanyUserTradeFairRestApiConstants::PERMISSION_KEY);

        return $this->permissionClient->hasPermissionToManageOwnTradeFairRepresentations($request);
    }
}
