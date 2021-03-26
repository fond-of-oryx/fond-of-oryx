<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Generated\Shared\Search\ErpOrderIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchOwnParamFilterQueryExpanderPlugin extends ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected $currentUser;

    /**
     * @var string[]
     */
    protected $companyUserExternalReferences = [];

    /**
     * @var string[]
     */
    protected $companyUserReferences = [];

    /**
     * @var string[]
     */
    protected $companyBusinessUnitUuids = [];

    /**
     * @var string[]
     */
    protected $companyBusinessUnitReferences = [];

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (count($requestParameters) > 0) {
            $this->prepareData();
            $externalReferences = $this->getFilterData(
                'request_params',
                ErpOrderIndexMap::EXTERNAL_REFERENCE,
                $requestParameters
            );
            $companyBusinessUnitUuids = $this->getFilterData(
                'request_params',
                ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID,
                $requestParameters
            );

            foreach ($companyBusinessUnitUuids as $index => $uuid) {
                if (in_array($uuid, $this->companyBusinessUnitUuids) === false) {
                    unset($companyBusinessUnitUuids[$index]);
                }
            }

            if (count($companyBusinessUnitUuids) === 0) {
                $companyBusinessUnitUuids[] = $this->getCustomer()->getCompanyUserTransfer()->getCompanyBusinessUnit()->getUuid();
            }

            $searchQuery = $this->addTerms(
                ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID,
                array_values($companyBusinessUnitUuids),
                $searchQuery
            );
            $searchQuery = $this->addTerms(
                ErpOrderIndexMap::EXTERNAL_REFERENCE,
                array_values($externalReferences),
                $searchQuery
            );
            unset($this->currentUser);
        }

        return $searchQuery;
    }

    /**
     * @param string $resource
     * @param string $field
     * @param array $filterData
     *
     * @return array
     */
    protected function getFilterData(string $resource, string $field, array $filterData): array
    {
        $filterCollection = [];
        if (array_key_exists($resource, $filterData) && array_key_exists($field, $filterData[$resource])) {
            foreach ($filterData[$resource][$field] as $filter) {
                $filterCollection[] = $filter;
            }
        }

        return $filterCollection;
    }
}
