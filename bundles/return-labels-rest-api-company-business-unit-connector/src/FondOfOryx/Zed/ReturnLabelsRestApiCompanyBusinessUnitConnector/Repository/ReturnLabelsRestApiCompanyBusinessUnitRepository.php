<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository\ReturnLabelsRestApiCompanyBusinessUnitPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCompanyBusinessUnitRepository extends AbstractRepository
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByIdCustomer(int $idCustomer): ?CompanyBusinessUnitTransfer
    {
        $spyCompanyBuinessUnitQuery = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear();

        $spyCompanyBuinessUnitEntity = $spyCompanyBuinessUnitQuery
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($idCustomer)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->findOne();

        if ($spyCompanyBuinessUnitEntity === null) {
            return null;
        }

        return $this->getFactory()->createCompanyBusinessUnitTransferMapper()
            ->mapEntityToTransfer($spyCompanyBuinessUnitEntity, new CompanyBusinessUnitTransfer());
    }
}
