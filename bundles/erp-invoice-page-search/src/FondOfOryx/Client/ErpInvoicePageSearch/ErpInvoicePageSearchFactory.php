<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;

/**
 * Class ErpInvoicePageSearchFactory
 *
 * @method \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 *
 * @package FondOfOryx\Client\ErpInvoicePageSearch
 */
class ErpInvoicePageSearchFactory extends AbstractFactory
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
     * @return \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientInterface
     */
    public function getCustomerClient(): ErpInvoicePageSearchToCustomerClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface
     */
    public function getErpInvoicePermissionClient(): ErpInvoicePageSearchToErpInvoicePermissionClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::CLIENT_ERP_INVOICE_PERMISSION);
    }

    /**
     * @return \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientInterface
     */
    public function getSearchClient(): ErpInvoicePageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected function getSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getSearchResultFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    public function getSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER);
    }
}
