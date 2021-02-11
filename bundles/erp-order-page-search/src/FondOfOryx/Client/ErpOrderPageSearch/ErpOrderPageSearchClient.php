<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface;
use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ErpOrderCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Kernel\PermissionAwareTrait;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchClient extends AbstractClient implements ErpOrderPageSearchClientInterface
{
    use PermissionAwareTrait;

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface
     */
    protected function getZedStub(): ErpOrderPageSearchStubInterface
    {
        return $this->getFactory()->createZedStub();
    }

    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer  $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request
    ): ErpOrderCollectionTransfer {
        return $this->getZedStub()->findErpOrdersByFilterTransfer($request);
    }

    /**
     * {@inheritDoc}
     *
     * @param  string  $searchString
     * @param  array  $requestParameters
     *
     * @return array
     * @api
     *
     */
    public function search(string $searchString, array $requestParameters = [])
    {
        if ($this->canSeeErpOrders() === false){
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
        return $this->can(SeeErpOrdersPermissionPlugin::KEY,
            $this->getCustomer()->getCompanyUserTransfer()->getFkCompany());
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
