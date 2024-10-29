<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander;

use FondOfOryx\Shared\ProductStyleSearchExpander\ProductStyleSearchExpanderConstants;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ProductStyleSearchExpander\ProductStyleSearchExpanderFactory getFactory()
 */
class ProductStyleSearchExpanderClient extends AbstractClient implements ProductStyleSearchExpanderClientInterface
{
    /**
     * @param string $modelKey
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKeyAndStyleKey(string $modelKey, string $styleKey): ?array
    {
        return $this->getFactory()
            ->getCatalogClient()
            ->catalogSearch('', [
                ProductStyleSearchExpanderConstants::MODEL_KEY => $modelKey,
                ProductStyleSearchExpanderConstants::STYLE_KEY => $styleKey,
            ]);
    }

    /**
     * @param string $modelKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKey(string $modelKey): ?array
    {
        return $this->getFactory()
            ->getCatalogClient()
            ->catalogSearch('', [
                ProductStyleSearchExpanderConstants::MODEL_KEY => $modelKey,
            ]);
    }

    /**
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameStyleKey(string $styleKey): ?array
    {
        return $this->getFactory()
            ->getCatalogClient()
            ->catalogSearch('', [
                ProductStyleSearchExpanderConstants::STYLE_KEY => $styleKey,
            ]);
    }

    /**
     * @deprecated
     *
     * @param string $modelKey
     * @param string $styleKey
     * @param string|null $optionDontMergeSizes
     *
     * @return array|null
     */
    public function getSimilarProducts(string $modelKey, string $styleKey, ?string $optionDontMergeSizes): ?array
    {
        return $this->getFactory()
            ->getCatalogClient()
            ->catalogSearch('', [
                ProductStyleSearchExpanderConstants::MODEL_KEY => $modelKey,
                ProductStyleSearchExpanderConstants::STYLE_KEY => $styleKey,
                ProductStyleSearchExpanderConstants::OPTION_DONT_MERGE_SIZES => $optionDontMergeSizes,
            ]);
    }
}
