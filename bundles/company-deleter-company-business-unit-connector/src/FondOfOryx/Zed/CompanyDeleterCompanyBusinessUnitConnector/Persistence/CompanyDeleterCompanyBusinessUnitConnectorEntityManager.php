<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method getFactory()
 */
class CompanyDeleterCompanyBusinessUnitConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyBusinessUnitByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $companyBusinessUnits = $this->getFactory()->createSpyCompanyBusinessUnitQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($companyBusinessUnits as $companyBusinessUnit) {
            foreach ($companyBusinessUnit->getSpyCompanyUnitAddressToCompanyBusinessUnits() as $companyUnitAddressToCompanyBusinessUnit) {
                $companyUnitAddressToCompanyBusinessUnit->getCompanyUnitAddress()->delete();
                $companyUnitAddressToCompanyBusinessUnit->delete();
            }
            $companyBusinessUnit->delete();
        }
    }
}
