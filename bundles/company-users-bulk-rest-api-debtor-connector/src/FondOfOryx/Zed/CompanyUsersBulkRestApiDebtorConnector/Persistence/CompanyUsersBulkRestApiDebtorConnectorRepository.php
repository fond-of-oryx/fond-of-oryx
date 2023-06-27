<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence\CompanyUsersBulkRestApiDebtorConnectorPersistenceFactory getFactory()
 */
class CompanyUsersBulkRestApiDebtorConnectorRepository extends AbstractRepository implements CompanyUsersBulkRestApiDebtorConnectorRepositoryInterface
{
    /**
     * @param array $debtorNumbers
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function findCompaniesByDebtorNumbers(array $debtorNumbers): CompanyCollectionTransfer
    {
        $collection = new CompanyCollectionTransfer();

        if (count($debtorNumbers) === 0) {
            return $collection;
        }
        $entityCollection = $this->getFactory()->getCompanyQuery()
            ->filterByDebtorNumber_In($debtorNumbers)
            ->find();

        /** @var \Orm\Zed\Company\Persistence\SpyCompany $entity */
        foreach ($entityCollection->getData() as $entity) {
            $companyTransfer = (new CompanyTransfer())->fromArray($entity->toArray(), true);
            foreach ($entity->getCompanyBusinessUnits() as $companyBusinessUnit) {
                $companyTransfer->addCompanyBusinessUnit((new CompanyBusinessUnitTransfer())->fromArray($companyBusinessUnit->toArray(), true));
            }

            foreach ($entity->getCompanyRoles() as $role) {
                $companyTransfer->addCompanyRole((new CompanyRoleTransfer())->fromArray($role->toArray(), true));
            }
            $collection->addCompany($companyTransfer);
        }

        return $collection;
    }
}
