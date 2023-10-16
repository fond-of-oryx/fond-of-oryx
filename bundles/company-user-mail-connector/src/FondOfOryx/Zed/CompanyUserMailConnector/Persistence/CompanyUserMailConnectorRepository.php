<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Persistence;

use Generated\Shared\Transfer\NotificationCustomerCollectionTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorPersistenceFactory getFactory()
 */
class CompanyUserMailConnectorRepository extends AbstractRepository implements CompanyUserMailConnectorRepositoryInterface
{
    /**
     * @param int $fkCompany
     * @param array<string> $roleNames
     *
     * @return \Generated\Shared\Transfer\NotificationCustomerCollectionTransfer
     */
    public function getNotificationCustomerByFkCompanyAndRole(int $fkCompany, array $roleNames): NotificationCustomerCollectionTransfer
    {
        $customerQuery = $this->getFactory()->getSpyCustomerQuery();

        $customerQuery
            ->useCompanyUserQuery()
                ->filterByFkCompany($fkCompany)
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyRoleQuery()
                        ->filterByName_In($roleNames)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select([SpyCustomerTableMap::COL_FIRST_NAME, SpyCustomerTableMap::COL_LAST_NAME, SpyCustomerTableMap::COL_EMAIL, SpyCompanyRoleTableMap::COL_NAME]);

        return $this->createCompanyUserCollectionByCustomerData($customerQuery->find()->getData());
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\NotificationCustomerCollectionTransfer
     */
    protected function createCompanyUserCollectionByCustomerData(array $data): NotificationCustomerCollectionTransfer
    {
        $collection = new NotificationCustomerCollectionTransfer();

        foreach ($data as $userData) {
            $customer = (new NotificationCustomerTransfer())
                ->setFirstName($userData[SpyCustomerTableMap::COL_FIRST_NAME])
                ->setLastName($userData[SpyCustomerTableMap::COL_FIRST_NAME])
                ->setRole($userData[SpyCompanyRoleTableMap::COL_NAME])
                ->setEmail($userData[SpyCustomerTableMap::COL_EMAIL]);

            $collection->addNotificationCustomer($customer);
        }

        return $collection;
    }
}
