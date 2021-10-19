<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiFactory getFactory()
 */
class CompanyUserSearchRestApiClient extends AbstractClient implements CompanyUserSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        return $this->getFactory()
            ->createZedCompanyUserSearchRestApiStub()
            ->searchCompanyUser($companyUserListTransfer);
    }
}
