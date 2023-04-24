<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission;

use Exception;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionFactory getFactory()
 */
class RepresentativeCompanyUserRestApiPermissionClient extends AbstractClient implements RepresentativeCompanyUserRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        $transfer = $this->getFactory()
            ->createRepresentativeCompanyUserRestApiPermissionStub()
            ->hasPermissionToManageOwnRepresentations($representationOfSalesPermissionRequestTransfer);

        if ($transfer instanceof RepresentativeCompanyUserRestApiPermissionResponseTransfer) {
            return $transfer->getHasPermissionToManageOwnRepresentations() ?? false;
        }

        throw new Exception('Wrong response!');
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        $transfer = $this->getFactory()
            ->createRepresentativeCompanyUserRestApiPermissionStub()
            ->hasPermissionToManageGlobalRepresentations($representationOfSalesPermissionRequestTransfer);

        if ($transfer instanceof RepresentativeCompanyUserRestApiPermissionResponseTransfer) {
            return $transfer->getHasPermissionToManageGlobalRepresentations() ?? false;
        }

        throw new Exception('Wrong response!');
    }
}
