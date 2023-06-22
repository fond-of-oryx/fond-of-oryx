<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Exception;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
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
            return false;
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
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomer(RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer): CustomerTransfer
    {
        $entity = $this->getCustomerQuery($restCompanyUsersBulkItemCustomerTransfer)->findOne();

        if ($entity === null) {
            throw new Exception(sprintf('Could not find customer by given email "%s" or reference "%s"', $restCompanyUsersBulkItemCustomerTransfer->getEmail(), $restCompanyUsersBulkItemCustomerTransfer->getCustomerReference()));
        }

        return (new CustomerTransfer())->fromArray($entity->toArray(), true);
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

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompany(RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer): CompanyTransfer
    {
        $entity = $this->getCompanyQuery($restCompanyUsersBulkItemCompanyTransfer)->findOne();

        if ($entity === null) {
            throw new Exception(sprintf('Could not find company by given id "%s" or debtor number "%s"', $restCompanyUsersBulkItemCompanyTransfer->getCompanyId(), $restCompanyUsersBulkItemCompanyTransfer->getDebtorNumber()));
        }

        $companyTransfer = (new CompanyTransfer())->fromArray($entity->toArray(), true);

        foreach ($entity->getCompanyBusinessUnits() as $companyBusinessUnit) {
            $companyTransfer->addCompanyBusinessUnit((new CompanyBusinessUnitTransfer())->fromArray($companyBusinessUnit->toArray(), true));
        }

        foreach ($entity->getCompanyRoles() as $role) {
            $companyTransfer->addCompanyRole((new CompanyRoleTransfer())->fromArray($role->toArray(), true));
        }

        return $companyTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer
     *
     * @throws \Exception
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function getCompanyQuery(RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer): SpyCompanyQuery
    {
        $query = $this->getFactory()->getCompanyQuery();
        $throw = true;

        if ($restCompanyUsersBulkItemCompanyTransfer->getCompanyId() !== null) {
            $query->filterByUuid($restCompanyUsersBulkItemCompanyTransfer->getCompanyId());
            $throw = false;
        }

        if ($restCompanyUsersBulkItemCompanyTransfer->getDebtorNumber() !== null) {
            $query->filterByDebtorNumber($restCompanyUsersBulkItemCompanyTransfer->getDebtorNumber());
            $throw = false;
        }

        if ($throw) {
            throw new Exception('At least company uuid or debtor number is required to find company!');
        }

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer
     *
     * @throws \Exception
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    protected function getCustomerQuery(
        RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer
    ): SpyCustomerQuery {
        $query = $this->getFactory()->getCustomerQuery();
        $throw = true;

        if ($restCompanyUsersBulkItemCustomerTransfer->getCustomerReference() !== null) {
            $query->filterByCustomerReference($restCompanyUsersBulkItemCustomerTransfer->getCustomerReference());
            $throw = false;
        }

        if ($restCompanyUsersBulkItemCustomerTransfer->getEmail() !== null) {
            $query->filterByEmail($restCompanyUsersBulkItemCustomerTransfer->getEmail());
            $throw = false;
        }

        if ($throw) {
            throw new Exception('At least customer reference or customer email is required to find customer!');
        }

        return $query;
    }
}
