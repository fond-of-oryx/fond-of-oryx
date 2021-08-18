<?php

namespace FondOfOryx\Zed\ErpOrderPermission\Persistence;

use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class ErpOrderPermissionRepository extends AbstractRepository implements ErpOrderPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference(
        string $permissionKey,
        string $customerReference
    ): CompanyBusinessUnitUuidCollectionTransfer {
        $spyCompanyRoleToPermissionQuery = SpyCompanyRoleToPermissionQuery::create();

        $ids = $spyCompanyRoleToPermissionQuery->usePermissionQuery()
                ->filterByKey(SeeErpOrdersPermissionPlugin::KEY)
            ->endUse()
            ->useCompanyRoleQuery()
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyUserQuery()
                        ->useCustomerQuery()
                            ->filterByCustomerReference($customerReference)
                        ->endUse()
                        ->useCompanyBusinessUnitQuery()
                            ->withColumn(SpyCompanyBusinessUnitTableMap::COL_UUID, 'uuid')
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select(['uuid'])
            ->find()
            ->getData();

        return (new CompanyBusinessUnitUuidCollectionTransfer())->setCompanyBusinessUnitIds($ids);
    }
}
