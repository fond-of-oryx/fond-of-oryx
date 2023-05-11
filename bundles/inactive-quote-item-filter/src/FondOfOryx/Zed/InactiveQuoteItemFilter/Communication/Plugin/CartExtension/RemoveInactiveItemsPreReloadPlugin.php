<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\PreReloadItemsPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\InactiveQuoteItemFilterCommunicationFactory getFactory()
 */
class RemoveInactiveItemsPreReloadPlugin extends AbstractPlugin implements PreReloadItemsPluginInterface
{
    /**
     * @var string
     */
    public const MESSAGE_PARAM_SKU = '%sku%';

    /**
     * @var string
     */
    public const MESSAGE_INFO_CONCRETE_INACTIVE_PRODUCT_REMOVED = 'product-cart.info.concrete-product-inactive.removed';

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function preReloadItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $storeName = $this->getStoreNameByQuote($quoteTransfer);

        if ($storeName === null) {
            return $quoteTransfer;
        }

        $skuToIndexes = $this->getSkuToIndexesByQuote($quoteTransfer);
        $skus = array_keys($skuToIndexes);
        $activeSkus = $this->getRepository()->getActiveSkusByStoreNameAndSkus($storeName, $skus);
        $inactiveSkus = array_diff($skus, $activeSkus);

        foreach ($inactiveSkus as $inactiveSku) {
            // @codeCoverageIgnoreStart
            if (!isset($skuToIndexes[$inactiveSku])) {
                continue;
            }
            // @codeCoverageIgnoreEnd

            foreach ($skuToIndexes[$inactiveSku] as $index) {
                $quoteTransfer->getItems()->offsetUnset($index);
            }

            $this->addFilterMessage($inactiveSku);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, array<int>>
     */
    protected function getSkuToIndexesByQuote(QuoteTransfer $quoteTransfer): array
    {
        $skuToIndexes = [];

        foreach ($quoteTransfer->getItems() as $index => $itemTransfer) {
            $sku = $itemTransfer->getSku();

            if (isset($skuToIndexes[$sku])) {
                $skuToIndexes[$sku][] = $index;

                continue;
            }

            $skuToIndexes[$sku] = [$index];
        }

        return $skuToIndexes;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string|null
     */
    protected function getStoreNameByQuote(QuoteTransfer $quoteTransfer): ?string
    {
        $storeTransfer = $quoteTransfer->getStore();

        if ($storeTransfer === null) {
            return null;
        }

        return $storeTransfer->getName();
    }

    /**
     * @param string $sku
     *
     * @return void
     */
    protected function addFilterMessage(string $sku): void
    {
        $messageTransfer = (new MessageTransfer())
            ->setValue(static::MESSAGE_INFO_CONCRETE_INACTIVE_PRODUCT_REMOVED)
            ->setParameters([static::MESSAGE_PARAM_SKU => $sku]);

        $this->getFactory()
            ->getMessengerFacade()
            ->addInfoMessage($messageTransfer);
    }
}
