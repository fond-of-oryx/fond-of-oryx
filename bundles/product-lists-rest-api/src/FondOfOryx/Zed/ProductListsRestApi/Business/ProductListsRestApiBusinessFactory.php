<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business;

use FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutor;
use FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpander;
use FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReader;
use FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdater;
use FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdaterInterface;
use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig getConfig()
 * @method \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface getRepository()
 */
class ProductListsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdaterInterface
     */
    public function createProductListUpdater(): ProductListUpdaterInterface
    {
        return new ProductListUpdater(
            $this->createProductListReader(),
            $this->createProductListExpander(),
            $this->createProductListPluginExecutor(),
            $this->getProductListFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface
     */
    protected function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->getRepository(),
            $this->getProductListFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface
     */
    protected function getProductListFacade(): ProductListsRestApiToProductListFacadeInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::FACADE_PRODUCT_LIST);
    }

    /**
     * @return \FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface
     */
    protected function createProductListExpander(): ProductListExpanderInterface
    {
        return new ProductListExpander(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface
     */
    protected function createProductListPluginExecutor(): ProductListPluginExecutorInterface
    {
        return new ProductListPluginExecutor(
            $this->getProductListUpdatePreCheckPlugins(),
            $this->getProductListPostUpdatePlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface>
     */
    protected function getProductListUpdatePreCheckPlugins(): array
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::PLUGINS_PRODUCT_LIST_UPDATE_PRE_CHECK);
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface>
     */
    protected function getProductListPostUpdatePlugins(): array
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::PLUGINS_PRODUCT_LIST_POST_UPDATE);
    }
}
