<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;

class RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionBridge implements RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface $client
     */
    public function __construct(RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToManageOwnTradeFairRepresentations($representativeCompanyUserTradeFairPermissionRequestTransfer);
    }
}
