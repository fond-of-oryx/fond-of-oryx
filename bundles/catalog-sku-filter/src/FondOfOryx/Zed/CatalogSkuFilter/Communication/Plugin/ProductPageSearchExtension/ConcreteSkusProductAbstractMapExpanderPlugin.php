<?php

namespace FondOfOryx\Zed\CatalogSkuFilter\Communication\Plugin\ProductPageSearchExtension;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

class ConcreteSkusProductAbstractMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    public const KEY_CONCRETE_SKUS = 'concrete_skus';

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
        if (!isset($productData[static::KEY_CONCRETE_SKUS])) {
            return $pageMapTransfer;
        }

        return $pageMapTransfer->setConcreteSkus(
            explode(', ', $productData[static::KEY_CONCRETE_SKUS])
        );
    }
}
