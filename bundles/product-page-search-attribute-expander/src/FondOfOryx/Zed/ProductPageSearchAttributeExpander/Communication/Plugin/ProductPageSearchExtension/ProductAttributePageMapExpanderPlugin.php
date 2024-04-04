<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearchExtension;

use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductAttributePageMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $productData,
        LocaleTransfer $localeTransfer
    ): PageMapTransfer {
        $productDataKey = ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES;

        if (!array_key_exists($productDataKey, $productData)) {
            return $pageMapTransfer;
        }

        $attributes = $productData[$productDataKey];

        $pageMapTransfer = $this->expandSearchResultData($pageMapTransfer, $pageMapBuilder, $attributes);

        return $this->expandSorting($pageMapTransfer, $pageMapBuilder, $attributes);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $attributes
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function expandSearchResultData(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $attributes
    ): PageMapTransfer {
        $pageMapBuilder->addSearchResultData(
            $pageMapTransfer,
            ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES,
            $attributes,
        );

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $attributes
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function expandSorting(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $attributes
    ): PageMapTransfer {
        $sortableIntegerAttributes = $this->getConfig()->getSortableIntegerAttributes();
        $sortableStringAttributes = $this->getConfig()->getSortableStringAttributes();

        foreach ($attributes as $attributeKey => $attributeValue) {
            if (is_string($attributeValue) && in_array($attributeKey, $sortableStringAttributes, true)) {
                $pageMapBuilder->addStringSort($pageMapTransfer, $attributeKey, $attributeValue);

                continue;
            }

            if (is_int($attributeValue) && in_array($attributeKey, $sortableIntegerAttributes, true)) {
                $pageMapBuilder->addIntegerSort($pageMapTransfer, $attributeKey, $attributeValue);

                continue;
            }
        }

        return $pageMapTransfer;
    }
}
