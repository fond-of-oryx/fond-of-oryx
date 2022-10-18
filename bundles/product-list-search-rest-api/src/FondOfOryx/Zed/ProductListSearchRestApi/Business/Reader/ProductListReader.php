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
    protected $repository;

    /**
     * @var array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    protected $searchQuoteQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface $repository
     * @param array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface> $searchQuoteQueryExpanderPlugins
     */
    public function __construct(
        ProductListSearchRestApiRepositoryInterface $repository,
        array $searchQuoteQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->searchQuoteQueryExpanderPlugins = $searchQuoteQueryExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(ProductListCollectionTransfer $productListCollectionTransfer): ProductListCollectionTransfer
    {
        $productListCollectionTransfer = $this->executeSearchQuoteQueryExpanderPlugins($productListCollectionTransfer);

        return $this->repository->findProductList($productListCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected function executeSearchQuoteQueryExpanderPlugins(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $productListCollectionTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchQuoteQueryExpanderPlugins as $searchQuoteQueryExpanderPlugin) {
            $queryJoinCollectionTransfer = $searchQuoteQueryExpanderPlugin
                ->expand($filterTransfers, $queryJoinCollectionTransfer);
        }

        return $productListCollectionTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
