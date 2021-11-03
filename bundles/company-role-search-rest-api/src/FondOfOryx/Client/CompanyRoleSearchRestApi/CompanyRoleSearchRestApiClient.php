<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiFactory getFactory()
 */
class CompanyRoleSearchRestApiClient extends AbstractClient implements CompanyRoleSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer
    {
        return $this->getFactory()
            ->createZedCompanyRoleSearchRestApiStub()
            ->searchCompanyRoles($companyRoleListTransfer);
    }
}
