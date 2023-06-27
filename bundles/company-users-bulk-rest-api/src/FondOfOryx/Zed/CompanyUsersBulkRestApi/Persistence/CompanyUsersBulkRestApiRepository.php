<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiPersistenceFactory getFactory()
 */
class CompanyUsersBulkRestApiRepository extends AbstractRepository implements CompanyUsersBulkRestApiRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference
    ): bool {
        $idPermission = $this->getIdPermissionByKey($permissionKey);

        if ($idPermission === null) {
            return true;
        }

        /** @var \Propel\Runtime\Collection\ArrayCollection|null $collection */
        $collection = $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->useCustomerQuery()
                ->filterByCustomerReference($customerReference)
            ->endUse()
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyRoleQuery()
                    ->useSpyCompanyRoleToPermissionQuery()
                        ->usePermissionQuery()
                            ->filterByIdPermission($idPermission)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->find();

        return $collection->count() > 0;
    }

    /**
     * @param string $key
     *
     * @return int|null
     */
    public function getIdPermissionByKey(string $key): ?int
    {
        /** @var int|null $idPermission */
        $idPermission = $this->getFactory()
            ->getPermissionQuery()
            ->clear()
            ->filterByKey($key)
            ->select([SpyPermissionTableMap::COL_ID_PERMISSION])
            ->findOne();

        return $idPermission;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findCompanyUser(CompanyUserTransfer $companyUserTransfer): ?CompanyUserTransfer
    {
        $companyUserTransfer
            ->requireFkCompany()
            ->requireFkCompanyBusinessUnit()
            ->requireFkCustomer();

        $entity = $this->getFactory()->getCompanyUserQuery()
            ->filterByFkCompany($companyUserTransfer->getFkCompany())
            ->filterByFkCustomer($companyUserTransfer->getFkCustomer())
            ->filterByFkCompanyBusinessUnit($companyUserTransfer->getFkCompanyBusinessUnit())
            ->findOne();

        if ($entity === null) {
            return null;
        }

        return (new CompanyUserTransfer())->fromArray($entity->toArray(), true);
    }

    /**
     * @param array $companyUuids
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function findCompaniesByUuids(array $companyUuids): CompanyCollectionTransfer
    {
        $collection = new CompanyCollectionTransfer();

        if (count($companyUuids) === 0) {
            return $collection;
        }
        $entityCollection = $this->getFactory()->getCompanyQuery()
            ->filterByUuid_In($companyUuids)
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

    /**
     * @param array $customerReferences
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function findCustomerByReferences(array $customerReferences): CustomerCollectionTransfer
    {
        $collection = new CustomerCollectionTransfer();
        if (count($customerReferences) === 0) {
            return $collection;
        }
        $entityCollection = $this->getFactory()->getCustomerQuery()
            ->filterByCustomerReference_In($customerReferences)
            ->find();

        /** @var \Orm\Zed\Customer\Persistence\SpyCustomer $entity */
        foreach ($entityCollection->getData() as $entity) {
            $customerTransfer = (new CustomerTransfer())->fromArray($entity->toArray(), true);
            $collection->addCustomer($customerTransfer);
        }

        return $collection;
    }

    /**
     * @param array $emailAddresses
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function findCustomerByEmail(array $emailAddresses): CustomerCollectionTransfer
    {
        $collection = new CustomerCollectionTransfer();

        if (count($emailAddresses) === 0) {
            return $collection;
        }

        $entityCollection = $this->getFactory()->getCustomerQuery()
            ->filterByEmail_In($emailAddresses)
            ->find();

        /** @var \Orm\Zed\Customer\Persistence\SpyCustomer $entity */
        foreach ($entityCollection->getData() as $entity) {
            $customerTransfer = (new CustomerTransfer())->fromArray($entity->toArray(), true);
            $collection->addCustomer($customerTransfer);
        }

        return $collection;
    }

    /**
     * @param int $idCompany
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function findCompanyUsersByFkCompanyAndFkCustomer(int $idCompany, int $idCustomer): CompanyUserCollectionTransfer
    {
        $results = $this->getFactory()->getCompanyUserQuery()
            ->filterByFkCompany($idCompany)
            ->filterByFkCustomer($idCustomer)
            ->find();

        $companyUserCollection = new CompanyUserCollectionTransfer();
        /** @var \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUser $entity */
        foreach ($results->getData() as $entity) {
            $companyUserTransfer = (new CompanyUserTransfer())->fromArray($entity->toArray(), true);
            $rolesToCompanyUser = $entity->getSpyCompanyRoleToCompanyUsersJoinCompanyRole();
            /** @var \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser $roleToCompanyUser */
            foreach ($rolesToCompanyUser->getData() as $roleToCompanyUser) {
                $companyUserTransfer->setCompanyRole((new CompanyRoleTransfer())->fromArray($roleToCompanyUser->getCompanyRole()->toArray(), true));
            }
            $companyUserCollection->addCompanyUser($companyUserTransfer);
        }

        return $companyUserCollection;
    }
}
