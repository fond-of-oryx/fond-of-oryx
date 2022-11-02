<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository extends AbstractRepository implements ReturnLabelsRestApiCompanyBusinessUnitConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByIdCustomer(int $idCustomer): ?CompanyBusinessUnitTransfer
    {
        $spyCompanyBusinessUnitQuery = $this->getFactory()
            ->getComanyBusinessUnitQuery()
            ->clear();

        $spyCompanyBusinessUnit = $spyCompanyBusinessUnitQuery
            ->useCompanyUserQuery()
                ->useCustomerQuery()
                    ->filterByIdCustomer($idCustomer)
                ->endUse()
            ->endUse()
            ->findOne();

        if ($spyCompanyBusinessUnit === null) {
            return null;
        }

        return $this->getFactory()->createCompanyBusinessUnitMapper()
            ->mapEntityToTransfer($spyCompanyBusinessUnit, new CompanyBusinessUnitTransfer());
    }
}
