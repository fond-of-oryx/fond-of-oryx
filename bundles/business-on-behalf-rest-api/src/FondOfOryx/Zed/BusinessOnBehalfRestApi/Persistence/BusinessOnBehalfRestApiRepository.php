<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence;

use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiPersistenceFactory getFactory()
 */
class BusinessOnBehalfRestApiRepository extends AbstractRepository implements BusinessOnBehalfRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function getIdCompanyUserByIdCustomerAndCompanyUserReference(
        int $idCustomer,
        string $companyUserReference
    ): ?int {
        /** @var int|null $idCompanyUser */
        $idCompanyUser = $this->getFactory()->getCompanyUserQuery()
            ->clear()
            ->filterByFkCustomer($idCustomer)
            ->filterByCompanyUserReference($companyUserReference)
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->findOne();

        return $idCompanyUser;
    }
}
