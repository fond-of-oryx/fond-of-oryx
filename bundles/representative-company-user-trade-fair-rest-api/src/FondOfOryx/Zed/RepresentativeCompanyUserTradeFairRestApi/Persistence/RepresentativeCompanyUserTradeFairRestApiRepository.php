<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence;

use Exception;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRestApiRepository extends AbstractRepository implements RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCustomerByReference(string $customerReference): int
    {
        $customer = $this->getFactory()->getCustomerQuery()->filterByCustomerReference($customerReference)->findOne();
        if ($customer === null) {
            throw new Exception(sprintf('Could not find customer by reference %s', $customerReference));
        }

        return $customer->getIdCustomer();
    }

    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param int $companyTypeId
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference,
        int $companyTypeId
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
            ->useCompanyQuery()
                ->filterByFkCompanyType($companyTypeId)
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
}
