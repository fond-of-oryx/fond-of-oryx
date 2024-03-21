<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence;

use ArrayObject;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiPersistenceFactory getFactory()
 */
class CompanyBusinessUnitAddressSearchRestApiRepository extends AbstractRepository implements CompanyBusinessUnitAddressSearchRestApiRepositoryInterface
{
    /**
     * @var string
     */
    public const KEY_DEFAULT_SHIPPING_IDS = 'defaultShippingAddressIds';

    /**
     * @var string
     */
    public const KEY_DEFAULT_BILLING_IDS = 'defaultBillingAddressIds';

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function searchCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): CompanyBusinessUnitAddressListTransfer {
        $defaultAddressIds = $this->getDefaultAddressIds($companyBusinessUnitAddressListTransfer);

        $companyUnitAddressQuery = $this->getBaseQuery($companyBusinessUnitAddressListTransfer);
        $companyUnitAddressQuery = $this->addCompanyQuery($companyUnitAddressQuery, $companyBusinessUnitAddressListTransfer);
        $companyUnitAddressQuery = $this->addAddressFilter(
            $companyUnitAddressQuery,
            $companyBusinessUnitAddressListTransfer,
            $defaultAddressIds,
        );

        $companyUnitAddressQuery = $this->addFulltextSearchFields($companyUnitAddressQuery, $companyBusinessUnitAddressListTransfer);
        $companyUnitAddressQuery = $this->addSort($companyUnitAddressQuery, $companyBusinessUnitAddressListTransfer);
        $companyUnitAddressQuery = $this->preparePagination($companyUnitAddressQuery, $companyBusinessUnitAddressListTransfer);

        $companyBusinessUnitAddresses = $this->getFactory()
            ->createCompanyBusinessUnitAddressMapper()
            ->mapEntityCollectionToTransfers($companyUnitAddressQuery->find(), $defaultAddressIds);

        return $companyBusinessUnitAddressListTransfer->setCompanyBusinessUnitAddresses(new ArrayObject($companyBusinessUnitAddresses));
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function getBaseQuery(CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer): SpyCompanyUnitAddressQuery
    {
        $query = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear();

        $uuids = $this->getFilterValuesByType($companyBusinessUnitAddressListTransfer->getFilterFields(), CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_ADDRESS_UUID);

        if (count($uuids) > 0) {
            $query->filterByUuid_In($uuids);
        }

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return array<string, array<int>>
     */
    protected function getDefaultAddressIds(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): array {
        $query = $this->getFactory()
            ->getCompanyBusinessUnitQuery();

        $companyBusinessUnitUuid = $this->getFilterValuesByType($companyBusinessUnitAddressListTransfer->getFilterFields(), CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID);
        if (count($companyBusinessUnitUuid) > 0) {
            $query->filterByUuid_In($companyBusinessUnitUuid);
        }

        $query
            ->clear()
            ->useCompanyUserQuery()
            ->filterByIsActive(true)
            ->filterByFkCustomer($companyBusinessUnitAddressListTransfer->getCustomerId())
            ->endUse();

        $companyId = $this->getFilterValueByType($companyBusinessUnitAddressListTransfer->getFilterFields(), CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);
        if ($companyId !== null) {
            $query->useCompanyQuery()
                ->filterByIsActive(true)
                ->filterByUuid($companyId)
                ->endUse();
        }

        $query->add(
            SpyCompanyBusinessUnitTableMap::COL_DEFAULT_SHIPPING_ADDRESS,
            null,
            Criteria::ISNOTNULL,
        )
            ->addOr(
                SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS,
                null,
                Criteria::ISNOTNULL,
            )->select([
                SpyCompanyBusinessUnitTableMap::COL_DEFAULT_SHIPPING_ADDRESS,
                SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS,
            ]);

        $defaultAddressIds = [
            static::KEY_DEFAULT_BILLING_IDS => [],
            static::KEY_DEFAULT_SHIPPING_IDS => [],
        ];

        foreach ($query->find()->getData() as $idPair) {
            if (
                array_key_exists(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $idPair)
                && $idPair[SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS] !== null
            ) {
                $defaultAddressIds[static::KEY_DEFAULT_BILLING_IDS][] = $idPair[SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS];
            }

            if (
                array_key_exists(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_SHIPPING_ADDRESS, $idPair)
                && $idPair[SpyCompanyBusinessUnitTableMap::COL_DEFAULT_SHIPPING_ADDRESS] !== null
            ) {
                $defaultAddressIds[static::KEY_DEFAULT_SHIPPING_IDS][] = $idPair[SpyCompanyBusinessUnitTableMap::COL_DEFAULT_SHIPPING_ADDRESS];
            }
        }

        return $defaultAddressIds;
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function addCompanyQuery(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): SpyCompanyUnitAddressQuery {
        $filter = $companyBusinessUnitAddressListTransfer->getFilterFields();
        $companyBusinessUnitUuid = $this->getFilterValuesByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID);
        $companyUuid = $this->getFilterValueByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);

        if ($companyUuid !== null && (count($companyBusinessUnitUuid) > 0)) {
            return $companyUnitAddressQuery
                ->useCompanyQuery()
                    ->useCompanyUserQuery()
                        ->filterByFkCustomer($companyBusinessUnitAddressListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByUuid($companyUuid)
                    ->filterByIsActive(true)
                    ->useCompanyBusinessUnitQuery()
                        ->filterByUuid_In($companyBusinessUnitUuid)
                    ->endUse()
                ->endUse();
        }

        if (count($companyBusinessUnitUuid) > 0) {
            return $companyUnitAddressQuery
                ->useCompanyQuery()
                    ->useCompanyUserQuery()
                        ->filterByFkCustomer($companyBusinessUnitAddressListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByIsActive(true)
                    ->useCompanyBusinessUnitQuery()
                        ->filterByUuid_In($companyBusinessUnitUuid)
                    ->endUse()
                ->endUse();
        }

        if ($companyUuid !== null) {
            return $companyUnitAddressQuery
                ->useCompanyQuery()
                    ->useCompanyUserQuery()
                        ->filterByFkCustomer($companyBusinessUnitAddressListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByUuid($companyUuid)
                    ->filterByIsActive(true)
                ->endUse();
        }

        return $companyUnitAddressQuery
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->filterByFkCustomer($companyBusinessUnitAddressListTransfer->getCustomerId())
                    ->filterByIsActive(true)
                    ->leftJoinCustomer()
                ->endUse()
                ->filterByIsActive(true)
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function addSort(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): SpyCompanyUnitAddressQuery {
        $sort = $this->getFilterValueByType($companyBusinessUnitAddressListTransfer->getFilterFields(), CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_SORT);

        if ($sort === null) {
            return $companyUnitAddressQuery;
        }

        $tableMap = SpyCompanyUnitAddressTableMap::getTableMap();
        $sortFields = $this->getFactory()->getConfig()->getSortFields();

        [$sortField, $direction] = explode(' ', preg_replace('/(([a-z0-9]+)(_[a-z0-9]+)*)_(asc|desc)/', '$1 $4', $sort));

        if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
            return $companyUnitAddressQuery;
        }

        $columnMap = $tableMap->getColumn($sortField);

        $companyUnitAddressQuery->orderBy(
            $columnMap->getFullyQualifiedName(),
            $direction === 'desc' ? Criteria::DESC : Criteria::ASC,
        );

        return $companyUnitAddressQuery;
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function addFulltextSearchFields(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): SpyCompanyUnitAddressQuery {
        $query = $this->getFilterValueByType($companyBusinessUnitAddressListTransfer->getFilterFields(), CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_FULL_TEXT);

        if ($query === null) {
            return $companyUnitAddressQuery;
        }

        $conditionNames = [];
        $tableMap = SpyCompanyUnitAddressTableMap::getTableMap();
        $fulltextSearchFields = $this->getFactory()->getConfig()->getFulltextSearchFields();

        foreach ($fulltextSearchFields as $fulltextSearchField) {
            if (!$tableMap->hasColumn($fulltextSearchField)) {
                continue;
            }

            $columnMap = $tableMap->getColumn($fulltextSearchField);

            if (!$columnMap->isText()) {
                continue;
            }

            $conditionNames[] = $conditionName = uniqid($fulltextSearchField, true);
            $companyUnitAddressQuery->addCond($conditionName, $columnMap->getFullyQualifiedName(), sprintf('%%%s%%', $query), Criteria::ILIKE);
        }

        if (count($conditionNames) === 0) {
            return $companyUnitAddressQuery;
        }

        $companyUnitAddressQuery->combine($conditionNames, Criteria::LOGICAL_OR);

        return $companyUnitAddressQuery;
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $companyBusinessUnitAddressListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $companyUnitAddressQuery->paginate($page, $maxPerPage);

        $paginationTransfer->setNbResults($propelModelPager->getNbResults())
            ->setFirstIndex($propelModelPager->getFirstIndex())
            ->setLastIndex($propelModelPager->getLastIndex())
            ->setFirstPage($propelModelPager->getFirstPage())
            ->setLastPage($propelModelPager->getLastPage())
            ->setNextPage($propelModelPager->getNextPage())
            ->setPreviousPage($propelModelPager->getPreviousPage());

        return $propelModelPager->getQuery();
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     * @param array<string, array<int>> $defaultAddressIds
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function addAddressFilter(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer,
        array $defaultAddressIds
    ): SpyCompanyUnitAddressQuery {
        $filter = $companyBusinessUnitAddressListTransfer->getFilterFields();
        $defaultShippingAddress = $this->getFilterValueByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_DEFAULT_SHIPPING);
        $defaultBillingAddress = $this->getFilterValueByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_DEFAULT_BILLING);

        if (
            $defaultShippingAddress === null &&
            $defaultBillingAddress === null
        ) {
            return $companyUnitAddressQuery;
        }

        return $this->addDefaultCompanyUnitAddressFilterQuery(
            $companyUnitAddressQuery,
            $companyBusinessUnitAddressListTransfer,
            $defaultAddressIds,
        );
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     * @param array<string, array<int>> $defaultAddressIds
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function addDefaultCompanyUnitAddressFilterQuery(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer,
        array $defaultAddressIds
    ): SpyCompanyUnitAddressQuery {
        $filter = $companyBusinessUnitAddressListTransfer->getFilterFields();
        $defaultShippingAddress = $this->getFilterValueByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_DEFAULT_SHIPPING);
        $defaultBillingAddress = $this->getFilterValueByType($filter, CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_DEFAULT_BILLING);

        $defaultBillingAddressIds = $defaultAddressIds[static::KEY_DEFAULT_BILLING_IDS];
        $defaultShippingAddressIds = $defaultAddressIds[static::KEY_DEFAULT_SHIPPING_IDS];

        if (
            $defaultBillingAddress === true
            && $defaultShippingAddress === true
        ) {
            $includeCompanyUnitAddressIds = array_intersect($defaultBillingAddressIds, $defaultShippingAddressIds);

            return $this->prepareCompanyUnitAddressFilter(
                $companyUnitAddressQuery,
                count($includeCompanyUnitAddressIds) === 0 ? [-1] : $includeCompanyUnitAddressIds,
                [],
            );
        }

        if (
            $defaultBillingAddress === false
            && $defaultShippingAddress === false
        ) {
            $excludeCompanyUnitAddressIds = array_unique(array_merge($defaultBillingAddressIds, $defaultShippingAddressIds));

            return $this->prepareCompanyUnitAddressFilter(
                $companyUnitAddressQuery,
                [],
                count($excludeCompanyUnitAddressIds) === 0 ? [-1] : $excludeCompanyUnitAddressIds,
            );
        }

        $includeCompanyUnitAddressIds = [];
        $excludeCompanyUnitAddressIds = [];

        if ($defaultBillingAddress === true) {
            $includeCompanyUnitAddressIds = count($defaultBillingAddressIds) === 0 ? [-1] : $defaultBillingAddressIds;
        }

        if ($defaultShippingAddress === true) {
            $includeCompanyUnitAddressIds = count($defaultShippingAddressIds) === 0 ? [-1] : $defaultShippingAddressIds;
        }

        if (
            count($defaultBillingAddressIds) > 0
            && $defaultBillingAddress === false
        ) {
            $excludeCompanyUnitAddressIds = $defaultBillingAddressIds;
        }

        if (
            count($defaultShippingAddressIds) > 0
            && $defaultShippingAddress === false
        ) {
            $excludeCompanyUnitAddressIds = $defaultShippingAddressIds;
        }

        return $this->prepareCompanyUnitAddressFilter(
            $companyUnitAddressQuery,
            $includeCompanyUnitAddressIds,
            $excludeCompanyUnitAddressIds,
        );
    }

    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $companyUnitAddressQuery
     * @param array<int> $includeCompanyUnitAddressIds
     * @param array<int> $excludeCompanyUnitAddressIds
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    protected function prepareCompanyUnitAddressFilter(
        SpyCompanyUnitAddressQuery $companyUnitAddressQuery,
        array $includeCompanyUnitAddressIds,
        array $excludeCompanyUnitAddressIds
    ): SpyCompanyUnitAddressQuery {
        if (count($includeCompanyUnitAddressIds) > 0 && count($excludeCompanyUnitAddressIds) > 0) {
            return $companyUnitAddressQuery->filterByIdCompanyUnitAddress_In($includeCompanyUnitAddressIds)
                ->filterByIdCompanyUnitAddress($excludeCompanyUnitAddressIds, Criteria::NOT_IN);
        }

        if (count($includeCompanyUnitAddressIds) > 0) {
            return $companyUnitAddressQuery->filterByIdCompanyUnitAddress_In($includeCompanyUnitAddressIds);
        }

        if (count($excludeCompanyUnitAddressIds) > 0) {
            return $companyUnitAddressQuery->filterByIdCompanyUnitAddress($excludeCompanyUnitAddressIds, Criteria::NOT_IN);
        }

        return $companyUnitAddressQuery;
    }

    /**
     * @param \ArrayObject $filterCollection
     * @param string $type
     *
     * @return string|int|bool|null
     */
    protected function getFilterValueByType(ArrayObject $filterCollection, string $type): string|int|bool|null
    {
        foreach ($filterCollection as $filter) {
            if ($filter->getType() !== $type) {
                continue;
            }

            if ($filter->getIsBool()) {
                return filter_var($filter->getValue(), FILTER_VALIDATE_BOOLEAN);
            }
            if ($filter->getIsInt()) {
                return filter_var($filter->getValue(), FILTER_VALIDATE_INT);
            }

            return $filter->getValue();
        }

        return null;
    }

    /**
     * @param \ArrayObject $filterCollection
     * @param string $type
     *
     * @return array<string|int|bool>
     */
    protected function getFilterValuesByType(ArrayObject $filterCollection, string $type): array
    {
        $data = [];

        foreach ($filterCollection as $filter) {
            if ($filter->getType() !== $type) {
                continue;
            }

            if ($filter->getIsBool()) {
                $data[] = filter_var($filter->getValue(), FILTER_VALIDATE_BOOLEAN);

                continue;
            }
            if ($filter->getIsInt()) {
                $data[] = filter_var($filter->getValue(), FILTER_VALIDATE_INT);

                continue;
            }
            $data[] = $filter->getValue();
        }

        return $data;
    }
}
