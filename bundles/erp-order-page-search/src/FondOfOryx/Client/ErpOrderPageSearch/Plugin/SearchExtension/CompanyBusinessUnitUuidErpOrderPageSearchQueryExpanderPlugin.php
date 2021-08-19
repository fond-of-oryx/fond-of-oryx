<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Generated\Shared\Search\ErpOrderIndexMap;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class CompanyBusinessUnitUuidErpOrderPageSearchQueryExpanderPlugin extends AbstractPlugin implements
    QueryExpanderPluginInterface
{
    protected const NIL_UUID = '00000000-0000-0000-0000-000000000000';

    /**
     * @var array|null
     */
    protected $availableCompanyBusinessUnitUuids;

    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        $companyBusinessUnitUuids = array_values(
            array_intersect(
                $this->getCompanyBusinessUnitUuidsByRequestParameters($requestParameters),
                $this->getAvailableCompanyBusinessUnitUuids()
            )
        );

        if (count($companyBusinessUnitUuids) === 0) {
            $companyBusinessUnitUuids[] = static::NIL_UUID;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Terms(ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID, $companyBusinessUnitUuids));

        return $searchQuery;
    }

    /**
     * @param array $requestParameters
     *
     * @return string[]
     */
    protected function getCompanyBusinessUnitUuidsByRequestParameters(array $requestParameters): array
    {
        if (!isset($requestParameters[ErpOrderPageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID])) {
            return $this->getAvailableCompanyBusinessUnitUuids();
        }

        $companyBusinessUnitUuids = $requestParameters[ErpOrderPageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID];

        if (!is_array($companyBusinessUnitUuids) || count($companyBusinessUnitUuids) === 0) {
            return $this->getAvailableCompanyBusinessUnitUuids();
        }

        return $companyBusinessUnitUuids;
    }

    /**
     * @return string[]
     */
    protected function getAvailableCompanyBusinessUnitUuids(): array
    {
        if ($this->availableCompanyBusinessUnitUuids !== null) {
            return $this->availableCompanyBusinessUnitUuids;
        }

        $this->availableCompanyBusinessUnitUuids = [];

        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        if ($customerTransfer === null || $customerTransfer->getCustomerReference() === null) {
            return $this->availableCompanyBusinessUnitUuids;
        }

        $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer = (new ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer())
            ->setCustomerReference($customerTransfer->getCustomerReference())
            ->setPermissionKey(SeeErpOrdersPermissionPlugin::KEY);

        $companyBusinessUnitUuidCollectionTransfer = $this->getFactory()->getErpOrderPermissionClient()
            ->getAccessibleCompanyBusinessUnitUuids(
                $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
            );

        $this->availableCompanyBusinessUnitUuids = $companyBusinessUnitUuidCollectionTransfer->getCompanyBusinessUnitIds();

        return $this->availableCompanyBusinessUnitUuids;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();

        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(
                sprintf(
                    'Query expander available only with %s, got: %s',
                    BoolQuery::class,
                    get_class($boolQuery)
                )
            );
        }

        return $boolQuery;
    }
}
