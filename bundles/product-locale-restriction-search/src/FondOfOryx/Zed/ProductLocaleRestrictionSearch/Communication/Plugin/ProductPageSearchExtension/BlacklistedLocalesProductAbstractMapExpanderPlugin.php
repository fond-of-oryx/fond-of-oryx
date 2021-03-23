<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\ProductLocaleRestrictionSearchCommunicationFactory getFactory()
 */
class BlacklistedLocalesProductAbstractMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    protected const KEY_BLACKLISTED_LOCALES = 'blacklisted_locales';

    /**
     * {@inheritDoc}
     *
     * @api
     *
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
        if (!isset($productData[static::KEY_BLACKLISTED_LOCALES])) {
            return $pageMapTransfer;
        }

        return $pageMapTransfer->setBlacklistedLocales($productData[static::KEY_BLACKLISTED_LOCALES]);
    }
}
