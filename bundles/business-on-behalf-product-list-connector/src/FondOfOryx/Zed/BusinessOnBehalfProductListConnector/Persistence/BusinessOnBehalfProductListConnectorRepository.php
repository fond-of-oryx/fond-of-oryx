<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence;

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
            ->filterByIsDefault(true)
            ->filterByCompanyUserReference($companyUserReference)
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
            ->findOne();

        return $idCustomer;
    }
}
