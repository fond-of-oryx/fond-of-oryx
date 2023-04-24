<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission;

use Exception;
use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentationOfSalesPermissionResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\RepresentationOfSalesPermission\RepresentationOfSalesPermissionFactory getFactory()
 */
class RepresentationOfSalesPermissionClient extends AbstractClient implements RepresentationOfSalesPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        $transfer = $this->getFactory()
            ->createRepresentationOfSalesPermissionStub()
            ->hasPermissionToManageOwnRepresentations($representationOfSalesPermissionRequestTransfer);

        if ($transfer instanceof RepresentationOfSalesPermissionResponseTransfer) {
            return $transfer->getHasPermissionToManageOwnRepresentations() ?? false;
        }

        throw new Exception('Wrong response!');
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool {
        $transfer = $this->getFactory()
            ->createRepresentationOfSalesPermissionStub()
            ->hasPermissionToManageGlobalRepresentations($representationOfSalesPermissionRequestTransfer);

        if ($transfer instanceof RepresentationOfSalesPermissionResponseTransfer) {
            return $transfer->getHasPermissionToManageGlobalRepresentations() ?? false;
        }

        throw new Exception('Wrong response!');
    }
}
