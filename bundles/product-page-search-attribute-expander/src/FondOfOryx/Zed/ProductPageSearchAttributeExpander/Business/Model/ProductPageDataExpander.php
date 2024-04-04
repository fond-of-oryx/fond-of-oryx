<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\Model;

use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface;
use Generated\Shared\Transfer\ProductPageSearchTransfer;

class ProductPageDataExpander implements ProductPageDataExpanderInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_LOCALE = '_';

    protected ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface $productAttributeFacade;

    /**
     * @param \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface $productAttributeFacade
     */
    public function __construct(
        ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface $productAttributeFacade
    ) {
        $this->productAttributeFacade = $productAttributeFacade;
    }

    /**
     * @param array $productPageData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return array
     */
    public function expand(array $productPageData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): array
    {
        $idProductAbstract = $productAbstractPageSearchTransfer->getIdProductAbstract();
        $currentLocale = $productAbstractPageSearchTransfer->getLocale();

        $attributeValues = $this->productAttributeFacade->getProductAbstractAttributeValues($idProductAbstract);

        $localizedAttributes = $attributeValues[$currentLocale];
        $defaultAttributes = $attributeValues[static::DEFAULT_LOCALE];

        $productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES] = array_merge(
            array_diff_key($defaultAttributes, $localizedAttributes),
            $localizedAttributes,
        );

        return $productPageData;
    }
}
