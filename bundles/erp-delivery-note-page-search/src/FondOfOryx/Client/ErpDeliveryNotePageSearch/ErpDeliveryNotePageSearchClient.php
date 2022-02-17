<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Kernel\PermissionAwareTrait;

/**
 * @method \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchFactory getFactory()
 */
class ErpDeliveryNotePageSearchClient extends AbstractClient implements ErpDeliveryNotePageSearchClientInterface
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
    public function search(string $searchString, array $requestParameters = []): array
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
