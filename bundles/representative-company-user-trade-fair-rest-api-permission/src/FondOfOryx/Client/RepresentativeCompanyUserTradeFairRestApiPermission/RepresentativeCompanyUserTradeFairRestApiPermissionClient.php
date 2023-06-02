<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use Exception;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRestApiPermissionClient extends AbstractClient implements RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
    ): bool {
        $transfer = $this->getFactory()
            ->createRepresentativeCompanyUserTradeFairRestApiPermissionStub()
            ->hasPermissionToManageOwnTradeFairRepresentations($tradeFairRepresentationPermissionRequestTransfer);

        if ($transfer instanceof RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer) {
            return $transfer->getHasPermissionToManageOwnTradeFairRepresentations() ?? false;
        }

        throw new Exception('Wrong response!');
    }
}
