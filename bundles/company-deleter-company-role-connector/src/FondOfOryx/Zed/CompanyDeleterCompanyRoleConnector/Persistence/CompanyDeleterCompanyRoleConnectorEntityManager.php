<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class CompanyDeleterCompanyRoleConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyRoleConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyRolesByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $query = SpyCompanyRoleQuery::create();
        $roles = $query->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($roles as $role) {
            foreach ($role->getSpyCompanyRoleToPermissions() as $permission) {
                $permission->delete();
            }
            foreach ($role->getSpyCompanyRoleToCompanyUsers() as $roleToCompanyUser) {
                $roleToCompanyUser->delete();
            }

            $role->delete();
        }
    }
}
