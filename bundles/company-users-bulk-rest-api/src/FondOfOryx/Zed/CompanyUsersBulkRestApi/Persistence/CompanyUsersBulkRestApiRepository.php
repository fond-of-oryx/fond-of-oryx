<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCustomerTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
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
    ): bool
    {
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
     * @return bool
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function isCompanyUserAlreadyAvailable(CompanyUserTransfer $companyUserTransfer): bool
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
            return false;
        }

        return true;
    }

    /**
     * @param array $companyUuids
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCompanyCollectionTransfer
     */
    public function findCompaniesByUuids(array $companyUuids): CompanyUsersBulkCompanyCollectionTransfer
    {
        $collection = new CompanyUsersBulkCompanyCollectionTransfer();

        if (count($companyUuids) === 0) {
            return $collection;
        }
        $companyTransfers = $this->getCompanyTransfersByCompanyUuids($companyUuids);

        return $collection->setCompanies(new ArrayObject($companyTransfers));
    }

    /**
     * @param array $customerReferences
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function findCustomerByReferences(array $customerReferences): CompanyUsersBulkCustomerCollectionTransfer
    {
        $collection = new CompanyUsersBulkCustomerCollectionTransfer();

        if (count($customerReferences) === 0) {
            return $collection;
        }

        $result = $this->getFactory()->getCustomerQuery()->clear()
            ->filterByCustomerReference_In($customerReferences)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER, SpyCustomerTableMap::COL_CUSTOMER_REFERENCE])
            ->find();

        foreach ($result->getData() as $data) {
            $customerId = $data[SpyCustomerTableMap::COL_ID_CUSTOMER];
            $customerReference = $data[SpyCustomerTableMap::COL_CUSTOMER_REFERENCE];
            $customerTransfer = (new CompanyUsersBulkCustomerTransfer())
                ->setIdCustomer($customerId)
                ->setCustomerReference($customerReference);
            $collection->addCustomer($customerTransfer);
        }

        return $collection;
    }

    /**
     * @param array $emailAddresses
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer
     */
    public function findCustomerByEmail(array $emailAddresses): CompanyUsersBulkCustomerCollectionTransfer
    {
        $collection = new CompanyUsersBulkCustomerCollectionTransfer();

        if (count($emailAddresses) === 0) {
            return $collection;
        }

        $result = $this->getFactory()->getCustomerQuery()->clear()
            ->filterByEmail_In($emailAddresses)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER, SpyCustomerTableMap::COL_CUSTOMER_REFERENCE, SpyCustomerTableMap::COL_EMAIL])
            ->find();

        foreach ($result->getData() as $data) {
            $customerId = $data[SpyCustomerTableMap::COL_ID_CUSTOMER];
            $customerReference = $data[SpyCustomerTableMap::COL_CUSTOMER_REFERENCE];
            $mail = $data[SpyCustomerTableMap::COL_EMAIL];
            $customerTransfer = (new CompanyUsersBulkCustomerTransfer())
                ->setIdCustomer($customerId)
                ->setEmail($mail)
                ->setCustomerReference($customerReference);
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

    /**
     * @param array $companyIds
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    protected function getCompanyTransfersByCompanyUuids(array $companyUuids): array
    {
        $result = $this->getFactory()->getCompanyQuery()
            ->filterByUuid_In($companyUuids)
            ->select([SpyCompanyTableMap::COL_ID_COMPANY, SpyCompanyTableMap::COL_UUID])
            ->find();

        $collection = [];
        foreach ($result->getData() as $companyData){
            $idCompany = $companyData[SpyCompanyTableMap::COL_ID_COMPANY];
            $uuid = $companyData[SpyCompanyTableMap::COL_UUID];
            $collection[$idCompany] = (new CompanyUsersBulkCompanyTransfer())
                ->setIdCompany($idCompany)
                ->setUuid($uuid);
        }

        $collection = $this->appendCompanyBusinessUnitsToCompanyTransfers($collection);
        return $this->appendCompanyRolesToCompanyTransfers($collection);
    }

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function appendCompanyBusinessUnitsToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array
    {
        $companyUsersBulkCompanyTransfers = $this->prepareCompanyTransferArray($companyUsersBulkCompanyTransfers);

        $result = $this->getFactory()->getCompanyBusinessUnitQuery()
            ->filterByFkCompany_In(array_keys($companyUsersBulkCompanyTransfers))
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY])
            ->find();

        foreach ($result->getData() as $companyBusinessUnitData) {
            $idCompanyBusinessUnit = $companyBusinessUnitData[SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT];
            $idCompany = $companyBusinessUnitData[SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY];

            $companyUsersBulkCompanyBusinessUnitTransfer = (new CompanyUsersBulkCompanyBusinessUnitTransfer())
                ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

            $companyUsersBulkCompanyTransfer = $companyUsersBulkCompanyTransfers[$idCompany];
            $companyUsersBulkCompanyTransfer->addCompanyBusinessUnit($companyUsersBulkCompanyBusinessUnitTransfer);
            $companyUsersBulkCompanyTransfers[$idCompany] = $companyUsersBulkCompanyTransfer;
        }

        return $companyUsersBulkCompanyTransfers;
    }

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function appendCompanyRolesToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array
    {
        $companyUsersBulkCompanyTransfers = $this->prepareCompanyTransferArray($companyUsersBulkCompanyTransfers);

        $result = $this->getFactory()->getCompanyRoleQuery()
            ->filterByFkCompany_In(array_keys($companyUsersBulkCompanyTransfers))
            ->select([SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, SpyCompanyRoleTableMap::COL_FK_COMPANY, SpyCompanyRoleTableMap::COL_NAME])
            ->find();

        foreach ($result->getData() as $companyRoleData){
            $idCompanyRole = $companyRoleData[SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE];
            $idCompany = $companyRoleData[SpyCompanyRoleTableMap::COL_FK_COMPANY];
            $name = $companyRoleData[SpyCompanyRoleTableMap::COL_NAME];

            $companyRoleTransfer = (new CompanyUsersBulkCompanyRoleTransfer())
                ->setIdCompanyRole($idCompanyRole)
                ->setName($name);

            $companyUsersBulkCompanyTransfer = $companyUsersBulkCompanyTransfers[$idCompany];
            $companyUsersBulkCompanyTransfer->addCompanyRole($companyRoleTransfer);
            $companyUsersBulkCompanyTransfers[$idCompany] = $companyUsersBulkCompanyTransfer;
        }

        return $companyUsersBulkCompanyTransfers;
    }

    /**
     * @param array<\Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    protected function prepareCompanyTransferArray(array $companyUsersBulkCompanyTransfers): array
    {
        $prepared = [];
        foreach ($companyUsersBulkCompanyTransfers as $companyUsersBulkCompanyTransfer) {
            $prepared[$companyUsersBulkCompanyTransfer->getIdCompanyOrFail()] = $companyUsersBulkCompanyTransfer;
        }

        return $prepared;
    }
}
