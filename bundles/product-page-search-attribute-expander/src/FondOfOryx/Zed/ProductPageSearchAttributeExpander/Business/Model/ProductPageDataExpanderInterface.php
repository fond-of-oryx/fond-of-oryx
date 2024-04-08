<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\Model;

use Generated\Shared\Transfer\ProductPageSearchTransfer;

interface ProductPageDataExpanderInterface
{
    /**
     * @param array $productPageData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return array
     */
    public function expand(
        array $productPageData,
        ProductPageSearchTransfer $productAbstractPageSearchTransfer
    ): array;
}
