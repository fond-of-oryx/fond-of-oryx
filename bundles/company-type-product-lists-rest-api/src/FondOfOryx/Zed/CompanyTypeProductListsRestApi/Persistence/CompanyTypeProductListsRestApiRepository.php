<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCompanyPermissionPlugin;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCustomerPermissionPlugin;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiPersistenceFactory getFactory()
 */
class CompanyTypeProductListsRestApiRepository extends AbstractRepository implements CompanyTypeProductListsRestApiRepositoryInterface
{
    /**
     * @var string
     */
    public const RELATION_ALIAS_TEMP_COMPANY_USER = 'temp_company_user';

    /**
     * @var string
     */
    public const RELATION_ALIAS_TEMP_CUSTOMER = 'temp_customer';

    /**
     * @param int $currentIdCustomer
     * @param array<string> $customerReferences
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences(
        int $currentIdCustomer,
        array $customerReferences
    ): array {
        $fkCompanyType = $this->getFactory()
            ->getConfig()
            ->getIdCompanyTypeForManufacturer();

        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCompanyUserCollection */
        $spyCompanyUserCollection = $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->useCustomerQuery()
                ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->filterByIdCustomer($currentIdCustomer)
            ->endUse()
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyRoleQuery()
                    ->useSpyCompanyRoleToPermissionQuery()
                        ->usePermissionQuery()
                            ->filterByKey(CanAssignProductListToCustomerPermissionPlugin::KEY)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyQuery()
                ->useCompanyUserQuery(static::RELATION_ALIAS_TEMP_COMPANY_USER)
                    ->useCustomerQuery(static::RELATION_ALIAS_TEMP_CUSTOMER)
                        ->filterByAnonymizedAt(null, Criteria::ISNULL)
                        ->filterByCustomerReference_In($customerReferences)
                    ->endUse()
                    ->filterByIsActive(true)
                ->endUse()
                ->filterByIsActive(true)
                ->filterByFkCompanyType($fkCompanyType)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->find();

        return $spyCompanyUserCollection->toArray();
    }

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCustomerReferencesByCompanyUserIds(array $companyUserIds): array
    {
        $fkCompanyType = $this->getFactory()
            ->getConfig()
            ->getIdCompanyTypeForManufacturer();

        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCustomerCollection */
        $spyCustomerCollection = $this->getFactory()
            ->getCustomerQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->useCompanyQuery()
                    ->filterByIsActive(true)
                    ->filterByFkCompanyType($fkCompanyType)
                    ->useCompanyUserQuery(static::RELATION_ALIAS_TEMP_COMPANY_USER)
                        ->filterByIdCompanyUser_In($companyUserIds)
                    ->endUse()
                ->endUse()
                ->filterByIsActive(true)
            ->endUse()
            ->filterByAnonymizedAt(null, Criteria::ISNULL)
            ->groupByCustomerReference()
            ->select([SpyCustomerTableMap::COL_CUSTOMER_REFERENCE])
            ->find();

        return $spyCustomerCollection->toArray();
    }

    /**
     * @param int $currentIdCustomer
     * @param array $companyUuids
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids(
        int $currentIdCustomer,
        array $companyUuids
    ): array {
        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCompanyUserCollection */
        $spyCompanyUserCollection = $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->useCustomerQuery()
                ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->filterByIdCustomer($currentIdCustomer)
            ->endUse()
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyRoleQuery()
                    ->useSpyCompanyRoleToPermissionQuery()
                        ->usePermissionQuery()
                            ->filterByKey(CanAssignProductListToCompanyPermissionPlugin::KEY)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyQuery()
                ->filterByUuid_In($companyUuids)
                ->filterByIsActive(true)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->find();

        return $spyCompanyUserCollection->toArray();
    }

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCompanyUuidsByCompanyUserIds(array $companyUserIds): array
    {
        $fkCompanyType = $this->getFactory()
            ->getConfig()
            ->getIdCompanyTypeForManufacturer();

        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCompanyCollection */
        $spyCompanyCollection = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->filterByIdCompanyUser_In($companyUserIds)
            ->endUse()
            ->filterByIsActive(true)
            ->filterByFkCompanyType($fkCompanyType, Criteria::NOT_EQUAL)
            ->select([SpyCompanyTableMap::COL_UUID])
            ->find();

        return $spyCompanyCollection->toArray();
    }
}
