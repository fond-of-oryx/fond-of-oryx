<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Exception;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionFactory getFactory()
 */
class CompaniesRestApiPermissionClient extends AbstractClient implements CompaniesRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer
     * @throws \Exception
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): CompaniesRestApiPermissionResponseTransfer {
        $transfer = $this->getFactory()
            ->createCompaniesRestApiPermissionStub()
            ->hasPermissionToDeleteCompany($companiesRestApiPermissionRequestTransfer);

        if ($transfer instanceof CompaniesRestApiPermissionResponseTransfer) {
            return $transfer;
        }

        throw new Exception('Wrong response!');
    }
}
