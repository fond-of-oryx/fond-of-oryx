<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Updater;

use FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListUpdater implements ProductListUpdaterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface
     */
    protected $productListReader;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface
     */
    protected $productListExpander;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface
     */
    protected $productListPluginExecutor;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface $productListExpander
     * @param \FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface $productListPluginExecutor
     * @param \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface $productListFacade
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        ProductListExpanderInterface $productListExpander,
        ProductListPluginExecutorInterface $productListPluginExecutor,
        ProductListsRestApiToProductListFacadeInterface $productListFacade
    ) {
        $this->productListReader = $productListReader;
        $this->productListExpander = $productListExpander;
        $this->productListPluginExecutor = $productListPluginExecutor;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function update(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer {
        $restProductListUpdateResponseTransfer = (new RestProductListUpdateResponseTransfer())
            ->setIsSuccessful(false);

        $restProductListUpdateRequestTransfer = $this->productListPluginExecutor->executeRestProductListUpdateRequestExpanderPlugins(
            $restProductListUpdateRequestTransfer,
        );

        $productListTransfer = $this->productListReader->getByRestProductListUpdateRequest(
            $restProductListUpdateRequestTransfer,
        );

        if ($productListTransfer === null) {
            return $restProductListUpdateResponseTransfer;
        }

        $canUpdate = $this->productListPluginExecutor->executeProductListUpdatePreCheckPlugins(
            $restProductListUpdateRequestTransfer,
            $productListTransfer,
        );

        if ($canUpdate !== true) {
            return $restProductListUpdateResponseTransfer;
        }

        $productListTransfer = $this->productListExpander->expand(
            $productListTransfer,
            $restProductListUpdateRequestTransfer,
        );

        $productListResponseTransfer = $this->productListFacade->updateProductList($productListTransfer);

        if ($productListResponseTransfer->getIsSuccessful() !== true) {
            return $restProductListUpdateResponseTransfer;
        }

        $productListTransfer = $this->productListPluginExecutor->executeProductListPostUpdatePlugins(
            $restProductListUpdateRequestTransfer,
            $productListTransfer,
        );

        return $restProductListUpdateResponseTransfer->setIsSuccessful(true)
            ->setProductList($productListTransfer);
    }
}
