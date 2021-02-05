<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface;
use Generated\Shared\Transfer\ErpOrderCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchClient extends AbstractClient implements ErpOrderPageSearchClientInterface
{
    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface
     */
    protected function getZedStub(): ErpOrderPageSearchStubInterface
    {
        return $this->getFactory()->createZedStub();
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderCollectionTransfer
    {
        return $this->getZedStub()->findErpOrdersByFilterTransfer($request);
    }

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
}
