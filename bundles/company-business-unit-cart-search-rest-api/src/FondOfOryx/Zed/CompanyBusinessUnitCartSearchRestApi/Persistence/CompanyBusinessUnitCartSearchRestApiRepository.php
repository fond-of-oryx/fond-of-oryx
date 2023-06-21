<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\PermissionExtension\SeeAllCompanyBusinessUnitQuotesPermissionPlugin;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiPersistenceFactory getFactory()
 */
class CompanyBusinessUnitCartSearchRestApiRepository extends AbstractRepository implements CompanyBusinessUnitCartSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyBusinessUnitUuid
     *
     * @return int|null
     */
    public function getIdCompanyBusinessUnitByIdCustomerAndCompanyBusinessUnitUuid(
        int $idCustomer,
        string $companyBusinessUnitUuid
    ): ?int {
        $idPermission = $this->getIdPermissionByKey(SeeAllCompanyBusinessUnitQuotesPermissionPlugin::KEY);

        if ($idPermission === null) {
            return null;
        }

        /** @var int|null $idCompanyBusinessUnit */
        $idCompanyBusinessUnit = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->useCustomerQuery()
                    ->filterByIdCustomer($idCustomer)
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
            ->endUse()
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->findOneByUuid($companyBusinessUnitUuid);

        return $idCompanyBusinessUnit;
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
