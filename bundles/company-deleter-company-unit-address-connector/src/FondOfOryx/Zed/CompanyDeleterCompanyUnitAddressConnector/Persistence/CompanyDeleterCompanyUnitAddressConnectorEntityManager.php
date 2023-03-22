<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterCompanyUnitAddressConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUnitAddressByIdCompany(CompanyTransfer $companyTransfer): void
    {
        foreach ($this->getFactory()->createSpyCompanyUnitAddressQuery()->findByFkCompany($companyTransfer->getIdCompany()) as $address) {
            $address->delete();
        }
    }
}
