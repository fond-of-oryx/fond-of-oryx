<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Search\ErpOrderIndexMap;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin extends AbstractErpOrderPageSearchQueryExpanderPlugin
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
        if (count($requestParameters) === 0) {
            return $searchQuery;
        }

        $this->prepareData();
        $companyBusinessUnitUuids = $this->getFilterData(
            ErpOrderPageSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT,
            'uuid',
            $requestParameters['filters']
        );

        $uuids = array_keys($companyBusinessUnitUuids);

        foreach ($uuids as $uuid) {
            if (in_array($uuid, $uuids) === true) {
                continue;
            }

            unset($uuids[$uuid]);
        }

        if (count($uuids) === 0) {
            $uuids[] = $this->getCustomer()->getCompanyUserTransfer()->getCompanyBusinessUnit()->getUuid();
        }

        $searchQuery = $this->addTerms(
            ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID,
            $uuids,
            $searchQuery
        );

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
}
