<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Term;
use Exception;
use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchConfig;
use Generated\Shared\Search\ErpOrderIndexMap;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class CanAccessErpOrderPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    protected $currentUser;
    protected $companyUserExternalReferences = [];
    protected $companyUserReferences = [];
    protected $companyBusinessUnitUuids = [];
    protected $companyBusinessUnitReferences = [];

    /**
     * {@inheritDoc}
     *
     * @param  \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface  $searchQuery
     * @param  array  $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     * @api
     *
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        $this->checkPermissions();
        $this->prepareData();

        $externalRef = $this->getCustomer()->getExternalReference();
        $companyBusinessUnitId = $this->getCustomer()->getCompanyUserTransfer()->getCompanyBusinessUnit()->getUuid();

        if (array_key_exists(ErpOrderPageSearchConfig::COMPANY_BUSINESS_UNIT_ID,
                $requestParameters) && in_array($requestParameters[ErpOrderPageSearchConfig::COMPANY_BUSINESS_UNIT_ID],
                $this->companyBusinessUnitUuids, true)) {
            $companyBusinessUnitId = $requestParameters[ErpOrderPageSearchConfig::COMPANY_BUSINESS_UNIT_ID];
        }

        if (array_key_exists(ErpOrderPageSearchConfig::EXTERNAL_REFERENCE,
                $requestParameters) && in_array($requestParameters[ErpOrderPageSearchConfig::EXTERNAL_REFERENCE],
                $this->companyUserExternalReferences, true)) {
            $externalRef = $requestParameters[ErpOrderPageSearchConfig::EXTERNAL_REFERENCE];
        }

        $searchQuery = $this->addTerm(ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID,
            $companyBusinessUnitId, $searchQuery);
        $searchQuery = $this->addTerm(ErpOrderIndexMap::EXTERNAL_REFERENCE,
            $externalRef, $searchQuery);
        unset($this->currentUser);
        return $searchQuery;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected function getCustomer(): ?CustomerTransfer
    {
        if ($this->currentUser === null) {
            $this->currentUser = $this->getFactory()
                ->getCustomerClient()
                ->getCustomer();
        }
        return $this->currentUser;
    }

    /**
     * @return void
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function prepareData(): void
    {
        $customer = $this->getCustomer();
        $activeCompanyUsers = $this->getFactory()->getCompanyUserClient()->getActiveCompanyUsersByCustomerReference($customer);

        foreach ($activeCompanyUsers->getCompanyUsers() as $activeCompanyUser) {
            $this->companyUserReferences[] = $activeCompanyUser->getCompanyUserReference();
            $this->companyUserExternalReferences[] = $activeCompanyUser->getExternalReference();
            $this->companyBusinessUnitUuids[] = $activeCompanyUser->getCompanyBusinessUnit()->getUuid();
            $this->companyBusinessUnitReferences[] = $activeCompanyUser->getCompanyBusinessUnit()->getExternalReference();
        }
    }

    protected function checkPermissions(){
        $customer = $this->getCustomer();

        foreach ($this->getCustomer()->getPermissions()->getPermissions() as $permission){
            $key = $permission->getKey();
            if ($key){
                $lalala = '';
            }
        }
    }

    /**
     * @param  string  $key
     * @param  string  $value
     * @param  \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface  $searchQuery
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     * @throws \Exception
     */
    protected function addTerm(string $key, string $value, QueryInterface $searchQuery): QueryInterface
    {
        $term = (new Term())->setTerm(
            $key,
            $value
        );

        $this->getBoolQuery($searchQuery->getSearchQuery())->addMust($term);

        return $searchQuery;
    }

    /**
     * @param  \Elastica\Query  $query
     *
     * @return \Elastica\Query\BoolQuery
     * @throws \Exception
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new Exception(sprintf(
                'Wrong bool query provided with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
