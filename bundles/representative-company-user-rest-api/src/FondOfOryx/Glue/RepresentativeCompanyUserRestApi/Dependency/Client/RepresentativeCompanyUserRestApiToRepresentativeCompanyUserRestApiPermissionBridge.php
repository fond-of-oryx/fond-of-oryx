<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client;

use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClientInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

class RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridge implements RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClientInterface $client
     */
    public function __construct(RepresentativeCompanyUserRestApiPermissionClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToManageGlobalRepresentations($representativeCompanyUserPermissionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToManageOwnRepresentations($representativeCompanyUserPermissionRequestTransfer);
    }
}
