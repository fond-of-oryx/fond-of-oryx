<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

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
}
