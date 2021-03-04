<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Search\ErpOrderIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
class ErpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin extends AbstractErpOrderPageSearchQueryExpanderPlugin
{
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
            $externalReferences = $this->getFilterData(
                ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDER,
                ErpOrderIndexMap::EXTERNAL_REFERENCE,
                $requestParameters['filters']
            );

            $externalRefs = array_keys($externalReferences);

            $searchQuery = $this->addTerms(
                ErpOrderIndexMap::EXTERNAL_REFERENCE,
                $externalRefs,
                $searchQuery
            );
        }

        return $searchQuery;
    }
}
