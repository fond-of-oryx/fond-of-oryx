<?php

namespace FondOfOryx\Zed\ErpInvoicePermission\Persistence;

use FondOfOryx\Zed\ErpInvoicePermission\Communication\Plugin\Permission\SeeErpInvoicesPermissionPlugin;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class ErpInvoicePermissionRepository extends AbstractRepository implements ErpInvoicePermissionRepositoryInterface
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
                ->filterByKey(SeeErpInvoicesPermissionPlugin::KEY)
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
