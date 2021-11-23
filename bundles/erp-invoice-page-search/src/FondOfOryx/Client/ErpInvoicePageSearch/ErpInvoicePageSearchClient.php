<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use FondOfOryx\Client\ErpInvoicePermission\Plugin\Permission\SeeErpInvoicesPermissionPlugin;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Kernel\PermissionAwareTrait;

/**
 * @method \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchFactory getFactory()
 */
class ErpInvoicePageSearchClient extends AbstractClient implements ErpInvoicePageSearchClientInterface
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
        if ($this->can(SeeErpInvoicesPermissionPlugin::KEY) === false) {
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
}
