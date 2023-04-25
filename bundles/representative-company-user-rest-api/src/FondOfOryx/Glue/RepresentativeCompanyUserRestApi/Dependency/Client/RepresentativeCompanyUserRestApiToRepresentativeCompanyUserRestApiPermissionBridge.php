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
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToManageGlobalRepresentations($representationOfSalesPermissionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToManageOwnRepresentations($representationOfSalesPermissionRequestTransfer);
    }
}
