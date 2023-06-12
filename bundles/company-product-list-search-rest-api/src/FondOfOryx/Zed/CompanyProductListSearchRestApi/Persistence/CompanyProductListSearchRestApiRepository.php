<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence;

use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiPersistenceFactory getFactory()
 */
class CompanyProductListSearchRestApiRepository extends AbstractRepository implements CompanyProductListSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyUuid
     *
     * @return int|null
     */
    public function getIdCompanyUserByIdCustomerAndCompanyUuid(int $idCustomer, string $companyUuid): ?int
    {
        $query = $this->getFactory()
            ->getCompanyUserQuery()
            ->clear();

        /** @var int|null $idCompanyUser */
        $idCompanyUser = $query->filterByFkCustomer($idCustomer)
            ->filterByIsActive(true)
            ->useCompanyQuery()
                ->filterByIsActive(true)
                ->filterByUuid($companyUuid)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER]);

        return $idCompanyUser;
    }
}
