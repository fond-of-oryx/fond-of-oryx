<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;

/**
 * Class ErpDeliveryNotePageSearchFactory
 *
 * @method \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 *
 * @package FondOfOryx\Client\ErpDeliveryNotePageSearch
 */
class ErpDeliveryNotePageSearchFactory extends AbstractFactory
{
    /**
     * @param string $searchString
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function createSearchQuery(string $searchString): QueryInterface
    {
        $searchQuery = $this->getSearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
        }

        return $searchQuery;
    }

    /**
     * @return \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientInterface
     */
    public function getCustomerClient(): ErpDeliveryNotePageSearchToCustomerClientInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface
     */
    public function getErpDeliveryNotePermissionClient(): ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PERMISSION);
    }

    /**
     * @return \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientInterface
     */
    public function getSearchClient(): ErpDeliveryNotePageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected function getSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getSearchResultFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    public function getSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER);
    }
}
