<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission;

use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Shared\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConstants;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

class PermissionChecker implements PermissionCheckerInterface
{
    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
     */
    protected $permissionClient;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $requestMapper;

    /**
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface $permissionClient
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface $permissionRequestMapper
     */
    public function __construct(
        RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface $permissionClient,
        PermissionRequestMapperInterface $permissionRequestMapper
    ) {
        $this->permissionClient = $permissionClient;
        $this->requestMapper = $permissionRequestMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    public function can(RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer): bool
    {
        $originatorReference = $attributesTransfer->getReferenceOriginator();
        $request = $this->requestMapper->fromAttributesTransfer($attributesTransfer)
            ->setOriginatorReference($originatorReference)
            ->setPermissionKey(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_OWN);

        if ($request->getDistributorReference() !== $originatorReference) {
            $request->setPermissionKey(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_GLOBAL);

            return $this->permissionClient->hasPermissionToManageGlobalRepresentations($request);
        }

        return $this->permissionClient->hasPermissionToManageOwnRepresentations($request);
    }
}
