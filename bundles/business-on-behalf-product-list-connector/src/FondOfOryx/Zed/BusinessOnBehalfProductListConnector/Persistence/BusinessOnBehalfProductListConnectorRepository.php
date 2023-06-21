<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence;

use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorPersistenceFactory getFactory()
 */
class BusinessOnBehalfProductListConnectorRepository extends AbstractRepository implements BusinessOnBehalfProductListConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getDefaultIdCompanyUserByCustomerReference(string $customerReference): ?int
    {
        /** @var int|null $defaultIdCompanyUser */
        $defaultIdCompanyUser = $this->getFactory()->getCompanyUserQuery()->clear()
            ->filterByIsDefault(true)
            ->useCustomerQuery()
                ->filterByCustomerReference($customerReference)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->findOne();

        return $defaultIdCompanyUser;
    }

    /**
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function getIdCompanyUserByCompanyUserReference(string $companyUserReference): ?int
    {
        /** @var int|null $idCompanyUser */
        $idCompanyUser = $this->getFactory()->getCompanyUserQuery()->clear()
            ->filterByCompanyUserReference($companyUserReference)
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->findOne();

        return $idCompanyUser;
    }

    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int
    {
        /** @var int|null $idCustomer */
        $idCustomer = $this->getFactory()->getCustomerQuery()->clear()
            ->filterByCustomerReference($customerReference)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER])
            ->findOne();

        return $idCustomer;
    }
}
