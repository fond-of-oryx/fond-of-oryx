<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearch;

use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

/**
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductAttributePageMapExpanderPlugin extends AbstractPlugin implements ProductPageMapExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productPageData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductPageMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $productPageData,
        LocaleTransfer $localeTransfer
    ): PageMapTransfer {
        $productDataKey = ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES;

        if (!array_key_exists($productDataKey, $productPageData)) {
            return $pageMapTransfer;
        }

        $attributes = $productPageData[$productDataKey];

        $pageMapTransfer = $this->expandSearchResultData($pageMapTransfer, $pageMapBuilder, $attributes);

        return $this->expandSorting($pageMapTransfer, $pageMapBuilder, $attributes);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
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
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
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

            if (!is_int($attributeValue)) {
                continue;
            }

            if (!in_array($attributeKey, $sortableIntegerAttributes, true)) {
                continue;
            }

            $pageMapBuilder->addIntegerSort($pageMapTransfer, $attributeKey, $attributeValue);
        }

        return $pageMapTransfer;
    }
}
