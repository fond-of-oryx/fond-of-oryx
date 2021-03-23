<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearch;

use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Generated\Shared\Transfer\ProductPayloadTransfer;
use Spryker\Shared\ProductPageSearch\ProductPageSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\ProductLocaleRestrictionSearchCommunicationFactory getFactory()
 */
class BlacklistedLocalesProductPageDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    /**
     * {@inheritDoc}
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
        $productPayloadTransfer = $this->getProductPayloadByProductData($productData);

        if ($productPayloadTransfer === null) {
            return;
        }

        $productAbstractPageSearchTransfer->setBlacklistedLocales(
            $productPayloadTransfer->getBlacklistedLocales()
        );
    }

    /**
     * @param array $productData
     *
     * @return \Generated\Shared\Transfer\ProductPayloadTransfer|null
     */
    protected function getProductPayloadByProductData(array $productData): ?ProductPayloadTransfer
    {
        if (!isset($productData[ProductPageSearchConfig::PRODUCT_ABSTRACT_PAGE_LOAD_DATA])) {
            return null;
        }

        return $productData[ProductPageSearchConfig::PRODUCT_ABSTRACT_PAGE_LOAD_DATA];
    }
}
