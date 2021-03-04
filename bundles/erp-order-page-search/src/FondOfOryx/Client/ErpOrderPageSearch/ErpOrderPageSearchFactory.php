<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCompanyUserClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;

/**
 * Class ErpOrderPageSearchFactory
 *
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
class ErpOrderPageSearchFactory extends AbstractFactory
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
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface
     */
    public function getCustomerClient(): ErpOrderPageSearchToCustomerClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCompanyUserClientInterface
     */
    public function getCompanyUserClient(): ErpOrderPageSearchToCompanyUserClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface
     */
    public function getSearchClient(): ErpOrderPageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected function getSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::PLUGIN_SEARCH_QUERY);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getSearchResultFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER);
    }
}
