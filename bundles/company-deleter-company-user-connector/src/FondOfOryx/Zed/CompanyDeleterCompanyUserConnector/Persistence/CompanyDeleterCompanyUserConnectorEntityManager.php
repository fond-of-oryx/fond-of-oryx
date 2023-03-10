<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class CompanyDeleterCompanyUserConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyUserConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $query = SpyCompanyUserQuery::create();
        $user = $query->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($user as $singleUser) {
            $singleUser->delete();
        }
    }
}
