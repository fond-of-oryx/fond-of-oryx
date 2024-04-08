<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearch;

use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

/**
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductAttributePageDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    /**
     * @param array $productPageData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productPageData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        if (!isset($productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES]) && !isset($productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_ABSTRACT_DATA_INDEX][ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES])) {
            return;
        }

        $attributes = array_merge(
            json_decode($productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_ABSTRACT_DATA_INDEX][ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES], true),
            json_decode($productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES], true),
        );

        $productAbstractPageSearchTransfer->setAttributes($attributes);
    }
}
