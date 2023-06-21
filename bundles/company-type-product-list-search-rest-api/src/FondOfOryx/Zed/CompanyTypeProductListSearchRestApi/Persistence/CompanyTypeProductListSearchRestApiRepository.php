<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Communication\Plugin\PermissionExtension\SeeCustomerProductListsPermissionPlugin;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiPersistenceFactory getFactory()
 */
class CompanyTypeProductListSearchRestApiRepository extends AbstractRepository implements CompanyTypeProductListSearchRestApiRepositoryInterface
{
    /**
     * @var string
     */
    public const RELATION_ALIAS_TEMP_COMPANY_USER = 'temp_company_user';

    /**
     * @var string
     */
    public const COL_COUNT_OF_CUSTOMER = 'count_of_customer';

    /**
     * @param int $currentIdCustomer
     * @param string $customerReference
     *
     * @return bool
     */
    public function canSeeProductListsOfCustomer(
        int $currentIdCustomer,
        string $customerReference
    ): bool {
        $companyTypeNameForManufacturer = $this->getFactory()
            ->getConfig()
            ->getCompanyTypeNameForManufacturer();

        /** @var int|null $countOfCustomer */
        $countOfCustomer = $this->getFactory()
            ->getCustomerQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->useCompanyQuery()
                    ->useFosCompanyTypeQuery()
                        ->filterByName($companyTypeNameForManufacturer)
                    ->endUse()
                    ->useCompanyUserQuery(static::RELATION_ALIAS_TEMP_COMPANY_USER)
                        ->filterByIsActive(true)
                        ->filterByFkCustomer($currentIdCustomer)
                        ->useSpyCompanyRoleToCompanyUserQuery()
                            ->useCompanyRoleQuery()
                                ->useSpyCompanyRoleToPermissionQuery()
                                    ->usePermissionQuery()
                                        ->filterByKey(SeeCustomerProductListsPermissionPlugin::KEY)
                                    ->endUse()
                                ->endUse()
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByIsActive(true)
                ->endUse()
            ->endUse()
            ->filterByAnonymizedAt(null, Criteria::ISNULL)
            ->filterByCustomerReference($customerReference)
            ->groupByCustomerReference()
            ->withColumn('COUNT(*)', static::COL_COUNT_OF_CUSTOMER)
            ->select([static::COL_COUNT_OF_CUSTOMER])
            ->findOne();

        return $countOfCustomer !== null && $countOfCustomer > 0;
    }
}
