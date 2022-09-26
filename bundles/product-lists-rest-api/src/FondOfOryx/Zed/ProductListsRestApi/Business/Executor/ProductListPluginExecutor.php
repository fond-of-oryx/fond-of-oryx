<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Executor;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListPluginExecutor implements ProductListPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface>
     */
    protected $productListUpdatePreCheckPlugins;

    /**
     * @var array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface>
     */
    protected $productListPostUpdatePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface> $productListUpdatePreCheckPlugins
     * @param array<\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface> $productListPostUpdatePlugins
     */
    public function __construct(
        array $productListUpdatePreCheckPlugins,
        array $productListPostUpdatePlugins
    ) {
        $this->productListUpdatePreCheckPlugins = $productListUpdatePreCheckPlugins;
        $this->productListPostUpdatePlugins = $productListPostUpdatePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return bool
     */
    public function executeUpdatePreCheckPlugins(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): bool {
        foreach ($this->productListUpdatePreCheckPlugins as $productListUpdatePreCheckPlugin) {
            $result = $productListUpdatePreCheckPlugin->preCheck(
                $restProductListUpdateRequestTransfer,
                $productListTransfer,
            );

            if ($result !== true) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function executePostUpdatePlugins(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        foreach ($this->productListPostUpdatePlugins as $productListPostUpdatePlugin) {
            $productListTransfer = $productListPostUpdatePlugin->postUpdate(
                $restProductListUpdateRequestTransfer,
                $productListTransfer,
            );
        }

        return $productListTransfer;
    }
}
