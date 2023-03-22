<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterCompanyUserConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyUserConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $user = $this->getFactory()->createSpyCompanyUserQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($user as $singleUser) {
            $singleUser->delete();
        }
    }
}
