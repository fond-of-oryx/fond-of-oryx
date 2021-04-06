<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model;

use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;

class CartChecker implements CartCheckerInterface
{
    protected const MESSAGE_PARAM_SKU = '%sku%';
    protected const MESSAGE_INFO_RESTRICTED_PRODUCT_REMOVED = 'product-cart.info.restricted-product.removed';

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
     */
    protected $productLocaleRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade
     */
    public function __construct(
        ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade
    ) {
        $this->productLocaleRestrictionFacade = $productLocaleRestrictionFacade;
    }

    /**
     * @inheritDoc
     */
    public function preCheck(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        $cartPreCheckResponseTransfer = (new CartPreCheckResponseTransfer())->setIsSuccess(true);
        $currentLocale = $cartChangeTransfer->getCurrentLocale();

        if ($currentLocale === null) {
            return $cartPreCheckResponseTransfer;
        }

        $itemTransfers = $cartChangeTransfer->getItems();
        $blacklistedLocales = $this->getBlacklistedLocalesByItems($itemTransfers->getArrayCopy());

        if (count($blacklistedLocales) === 0) {
            return $cartPreCheckResponseTransfer;
        }

        foreach ($itemTransfers as $itemTransfer) {
            if ($this->isValidItem($itemTransfer, $currentLocale, $blacklistedLocales)) {
                continue;
            }

            $messageTransfer = (new MessageTransfer())
                ->setValue(static::MESSAGE_INFO_RESTRICTED_PRODUCT_REMOVED)
                ->setParameters([static::MESSAGE_PARAM_SKU => $itemTransfer->getSku()]);

            $cartPreCheckResponseTransfer->setIsSuccess(false)
                ->addMessage($messageTransfer);
        }

        return $cartPreCheckResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return array
     */
    protected function getBlacklistedLocalesByItems(array $itemTransfers): array
    {
        $productAbstractIds = array_map(static function (ItemTransfer $itemTransfer) {
            return $itemTransfer->getIdProductAbstract();
        }, $itemTransfers);

        if (empty($productAbstractIds)) {
            return [];
        }

        return $this->productLocaleRestrictionFacade->getBlacklistedLocalesByProductAbstractIds(
            $productAbstractIds
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param string $currentLocale
     * @param array $blacklistedLocales
     *
     * @return bool
     */
    protected function isValidItem(ItemTransfer $itemTransfer, string $currentLocale, array $blacklistedLocales): bool
    {
        $idProductAbstract = $itemTransfer->getIdProductAbstract();

        return !isset($blacklistedLocales[$idProductAbstract])
            || !in_array($currentLocale, $blacklistedLocales[$idProductAbstract], true);
    }
}
