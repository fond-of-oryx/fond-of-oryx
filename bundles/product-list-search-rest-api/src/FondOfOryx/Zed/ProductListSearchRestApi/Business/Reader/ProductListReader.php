<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader;

use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface
     */
    protected ProductListSearchRestApiRepositoryInterface $repository;

    /**
     * @var array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface>
     */
    protected array $searchProductListQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface $repository
     * @param array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface> $searchProductListQueryExpanderPlugins
     */
    public function __construct(
        ProductListSearchRestApiRepositoryInterface $repository,
        array $searchProductListQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->searchProductListQueryExpanderPlugins = $searchProductListQueryExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(ProductListCollectionTransfer $productListCollectionTransfer): ProductListCollectionTransfer
    {
        $productListCollectionTransfer = $this->executeSearchProductListQueryExpanderPlugins($productListCollectionTransfer);

        return $this->repository->findProductList($productListCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected function executeSearchProductListQueryExpanderPlugins(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $productListCollectionTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchProductListQueryExpanderPlugins as $searchQuoteQueryExpanderPlugin) {
            $queryJoinCollectionTransfer = $searchQuoteQueryExpanderPlugin
                ->expand($filterTransfers, $queryJoinCollectionTransfer);
        }

        return $productListCollectionTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
