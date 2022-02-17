<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use FondOfOryx\Zed\ErpDeliveryNotePermission\Communication\Plugin\Permission\SeeErpDeliveryNotesPermissionPlugin;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchFactory getFactory()
 */
class CompanyBusinessUnitUuidErpDeliveryNotePageSearchQueryExpanderPlugin extends AbstractPlugin implements
    QueryExpanderPluginInterface
{
    /**
     * @var string
     */
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
                $this->getAvailableCompanyBusinessUnitUuids(),
            ),
        );

        if (count($companyBusinessUnitUuids) === 0) {
            $companyBusinessUnitUuids[] = static::NIL_UUID;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Terms(ErpDeliveryNoteIndexMap::COMPANY_BUSINESS_UNIT_UUID, $companyBusinessUnitUuids));

        return $searchQuery;
    }

    /**
     * @param array $requestParameters
     *
     * @return array<string>
     */
    protected function getCompanyBusinessUnitUuidsByRequestParameters(array $requestParameters): array
    {
        if (!isset($requestParameters[ErpDeliveryNotePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID])) {
            return $this->getAvailableCompanyBusinessUnitUuids();
        }

        $companyBusinessUnitUuids = $requestParameters[ErpDeliveryNotePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID];

        if (!is_array($companyBusinessUnitUuids) || count($companyBusinessUnitUuids) === 0) {
            return $this->getAvailableCompanyBusinessUnitUuids();
        }

        return $companyBusinessUnitUuids;
    }

    /**
     * @return array<string>
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

        $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer = (new ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer())
            ->setCustomerReference($customerTransfer->getCustomerReference())
            ->setPermissionKey(SeeErpDeliveryNotesPermissionPlugin::KEY);

        $companyBusinessUnitUuidCollectionTransfer = $this->getFactory()->getErpDeliveryNotePermissionClient()
            ->getAccessibleCompanyBusinessUnitUuids(
                $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer,
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
                    get_class($boolQuery),
                ),
            );
        }

        return $boolQuery;
    }
}
