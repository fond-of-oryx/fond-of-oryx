<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Expander;

use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListExpander implements ProductListExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig $config
     */
    public function __construct(ProductListsRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expand(
        ProductListTransfer $productListTransfer,
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): ProductListTransfer {
        $restProductListsAttributesTransfer = $restProductListUpdateRequestTransfer->getProductList();

        if ($restProductListsAttributesTransfer === null) {
            return $productListTransfer;
        }

        $allowedFieldsToPatch = $this->config->getAllowedFieldsToPatch();

        foreach ($restProductListsAttributesTransfer->modifiedToArray() as $key => $value) {
            $method = sprintf('set%s', ucfirst(str_replace('_', '', ucwords($key, '_'))));

            if (!in_array($key, $allowedFieldsToPatch, true) || !method_exists($productListTransfer, $method)) {
                continue;
            }

            $productListTransfer->$method($value);
        }

        return $productListTransfer;
    }
}
