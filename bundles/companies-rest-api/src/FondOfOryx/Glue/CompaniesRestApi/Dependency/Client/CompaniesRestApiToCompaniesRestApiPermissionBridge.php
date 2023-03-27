<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Dependency\Client;

use FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClientInterface;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

class CompaniesRestApiToCompaniesRestApiPermissionBridge implements CompaniesRestApiToCompaniesRestApiPermissionInterface
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClientInterface $client
     */
    public function __construct(CompaniesRestApiPermissionClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): bool {
        return $this->client->hasPermissionToDeleteCompany($companiesRestApiPermissionRequestTransfer);
    }
}
