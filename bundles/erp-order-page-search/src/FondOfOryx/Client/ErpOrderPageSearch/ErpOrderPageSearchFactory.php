<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErporderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSessionClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToZedRequestClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStub;
use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface;
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
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createZedStub(): ErpOrderPageSearchStubInterface
    {
        return new ErpOrderPageSearchStub($this->getZedRequestClient());
    }

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
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToZedRequestClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getZedRequestClient(): ErpOrderPageSearchToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSessionClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getSessionClient(): ErpOrderPageSearchToSessionClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_SESSION);
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCustomerClient(): ErpOrderPageSearchToCustomerClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Client\ErporderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface
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
