<?php

namespace FondOfOryx\Zed\ProductStyleSearchExpander\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductPageData;

use FondOfOryx\Shared\ProductStyleSearchExpander\ProductStyleSearchExpanderConstants;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductPageDataExpanderPluginInterface;

class StyleKeyDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands the provided ProductAbstractPageSearch transfer object's data by reference.
     *
     * @api
     *
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(
        array $productData,
        ProductPageSearchTransfer $productAbstractPageSearchTransfer
    ): void {
        if (!isset($productData[ProductStyleSearchExpanderConstants::PRODUCT_ATTRIBUTES])) {
            return;
        }

        $productAttributes = json_decode($productData[ProductStyleSearchExpanderConstants::PRODUCT_ATTRIBUTES], true);

        if (array_key_exists(ProductStyleSearchExpanderConstants::STYLE_KEY, $productAttributes)) {
            $productAbstractPageSearchTransfer->setStyleKey($productAttributes[ProductStyleSearchExpanderConstants::STYLE_KEY]);
        }
    }
}
