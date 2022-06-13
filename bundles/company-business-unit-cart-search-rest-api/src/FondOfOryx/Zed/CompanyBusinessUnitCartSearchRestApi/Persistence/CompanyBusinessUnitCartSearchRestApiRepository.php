<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\PermissionExtension\SeeAllCompanyBusinessUnitQuotesPermissionPlugin;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
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
                                ->filterByKey(SeeAllCompanyBusinessUnitQuotesPermissionPlugin::KEY)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->findOneByUuid($companyBusinessUnitUuid);

        return $idCompanyBusinessUnit;
    }
}
