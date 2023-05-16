<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\CartPreCheckPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\InactiveQuoteItemFilterCommunicationFactory getFactory()
 */
class ProductExistsCartPreCheckPlugin extends AbstractPlugin implements CartPreCheckPluginInterface
{
    /**
     * @var string
     */
    public const MESSAGE_ERROR_CONCRETE_PRODUCT_INACTIVE = 'product-cart.validation.error.concrete-product-inactive';

    /**
     * @var string
     */
    public const MESSAGE_ERROR_MISSING_STORE = 'product-cart.validation.error.missing-store';

    /**
     * @var string
     */
    public const MESSAGE_PARAM_SKU = 'sku';

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function check(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        $cartPreCheckResponseTransfer = new CartPreCheckResponseTransfer();
        $storeName = $this->getStoreNameByCartChange($cartChangeTransfer);

        if ($storeName === null) {
            return $cartPreCheckResponseTransfer->setIsSuccess(false)
                ->addMessage($this->createMissingStoreErrorMessage());
        }

        $skuToIndexes = $this->getSkuToIndexesByCartChange($cartChangeTransfer);
        $skus = array_keys($skuToIndexes);
        $activeSkus = $this->getRepository()->getActiveSkusByStoreNameAndSkus($storeName, $skus);
        $inactiveSkus = array_diff($skus, $activeSkus);

        if (count($inactiveSkus) === 0) {
            return $cartPreCheckResponseTransfer->setIsSuccess(true);
        }

        foreach ($inactiveSkus as $inactiveSku) {
            $cartPreCheckResponseTransfer->addMessage($this->createItemInactiveErrorMessage($inactiveSku));
        }

        return $cartPreCheckResponseTransfer->setIsSuccess(false);
    }

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return array<string, array<int>>
     */
    protected function getSkuToIndexesByCartChange(CartChangeTransfer $cartChangeTransfer): array
    {
        $skuToIndexes = [];

        foreach ($cartChangeTransfer->getItems() as $index => $itemTransfer) {
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
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return string|null
     */
    protected function getStoreNameByCartChange(CartChangeTransfer $cartChangeTransfer): ?string
    {
        $quoteTransfer = $cartChangeTransfer->getQuote();

        if ($quoteTransfer === null) {
            return null;
        }

        $storeTransfer = $quoteTransfer->getStore();

        if ($storeTransfer === null) {
            return null;
        }

        return $storeTransfer->getName();
    }

    /**
     * @param string $sku
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function createItemInactiveErrorMessage(string $sku): MessageTransfer
    {
        return (new MessageTransfer())
            ->setValue(static::MESSAGE_ERROR_CONCRETE_PRODUCT_INACTIVE)
            ->setParameters([
                static::MESSAGE_PARAM_SKU => $sku,
            ]);
    }

    /**
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function createMissingStoreErrorMessage(): MessageTransfer
    {
        return (new MessageTransfer())
            ->setValue(static::MESSAGE_ERROR_MISSING_STORE);
    }
}
