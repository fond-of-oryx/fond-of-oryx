<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Exception;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer;
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
    ): bool
    {
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
     * @return \Generated\Shared\Transfer\CustomerTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findCustomer(RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer): CustomerTransfer
    {
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

        $result = $query->findOne();

        if ($result === null) {
            throw new Exception(sprintf('Could not find customer by given email "%s" or reference "%s"', $restCompanyUsersBulkItemCustomerTransfer->getEmail(), $restCompanyUsersBulkItemCustomerTransfer->getCustomerReference()));
        }

        return (new CustomerTransfer())->fromArray($result->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer
     * @return \Generated\Shared\Transfer\CompanyTransfer
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findCompany(RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer): CompanyTransfer
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

        $result = $query->findOne();

        if ($result === null) {
            throw new Exception(sprintf('Could not find company by given id "%s" or debtor number "%s"', $restCompanyUsersBulkItemCompanyTransfer->getCompanyId(), $restCompanyUsersBulkItemCompanyTransfer->getDebtorNumber()));
        }

        return (new CompanyTransfer())->fromArray($result->toArray(), true);
    }
}
