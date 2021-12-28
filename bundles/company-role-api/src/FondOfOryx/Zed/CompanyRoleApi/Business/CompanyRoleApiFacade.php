<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface getRepository()
 */
class CompanyRoleApiFacade extends AbstractFacade implements CompanyRoleApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyRole
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyRole(int $idCompanyRole): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyRoleApi()->get($idCompanyRole);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyRoles(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createCompanyRoleApi()->find($apiRequestTransfer);
    }
}
