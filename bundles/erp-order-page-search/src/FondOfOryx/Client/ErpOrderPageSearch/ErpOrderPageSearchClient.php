<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Kernel\PermissionAwareTrait;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchClient extends AbstractClient implements ErpOrderPageSearchClientInterface
{
    use PermissionAwareTrait;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function search(string $searchString, array $requestParameters = [])
    {
        if ($this->canSeeErpOrders() === false) {
            return [];
        }

        $searchQuery = $this
            ->getFactory()
            ->createSearchQuery($searchString);

        $searchQuery = $this
            ->getFactory()
            ->getSearchClient()
            ->expandQuery($searchQuery, $this->getFactory()->getSearchQueryExpanderPlugins(), $requestParameters);

        $resultFormatters = $this
            ->getFactory()
            ->getSearchResultFormatterPlugins();

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, $resultFormatters, $requestParameters);
    }

    /**
     * @return bool
     */
    protected function canSeeErpOrders(): bool
    {
        return $this->can(
            SeeErpOrdersPermissionPlugin::KEY,
            $this->getCustomer()->getCompanyUserTransfer()->getFkCompany()
        );
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected function getCustomer(): ?CustomerTransfer
    {
        return $this->getFactory()
            ->getCustomerClient()
            ->getCustomer();
    }
}
