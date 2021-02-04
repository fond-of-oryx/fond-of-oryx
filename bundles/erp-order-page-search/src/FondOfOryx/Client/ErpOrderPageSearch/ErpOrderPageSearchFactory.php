<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErporderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;
use Spryker\Client\Session\SessionClientInterface;

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
     */
    public function createZedStub()
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
     * @return mixed
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    protected function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_SESSION);
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
}
