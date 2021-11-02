<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart;

use ArrayObject;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\DecimalObject\Decimal;

class CheckCartAvailability implements CheckCartAvailabilityInterface
{
    /**
     * @var string
     */
    public const NAME_TRANSLATION_PARAMETER = '%name%';

    /**
     * @var string
     */
    public const SKU_TRANSLATION_PARAMETER = '%sku%';

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface
     */
    protected $availabilityCartConnectorFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface
     */
    protected $availabilityFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface $availabilityCartConnectorFacade
     * @param \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface $availabilityFacade
     */
    public function __construct(
        AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface $availabilityCartConnectorFacade,
        AvailabilityCartDataExtenderToAvailabilityFacadeInterface $availabilityFacade
    ) {
        $this->availabilityCartConnectorFacade = $availabilityCartConnectorFacade;
        $this->availabilityFacade = $availabilityFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function checkCartAvailability(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        $cartPreCheckResponseTransfer = $this->availabilityCartConnectorFacade->checkCartAvailability($cartChangeTransfer);

        foreach ($cartPreCheckResponseTransfer->getMessages() as &$message) {
            foreach ($cartChangeTransfer->getItems() as $item) {
                $params = $message->getParameters();
                if (array_key_exists(static::SKU_TRANSLATION_PARAMETER, $params) && $params[static::SKU_TRANSLATION_PARAMETER] === $item->getSku()) {
                    $params[static::NAME_TRANSLATION_PARAMETER] = $item->getName();
                    $message->setParameters($params);
                }
            }
        }

        return $cartPreCheckResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addAvailabilityInformationOnQuoteItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteTransfer->requireStore();
        $storeTransfer = $quoteTransfer->getStore();
        $itemsInCart = clone $quoteTransfer->getItems();

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getAmount() !== null) {
                continue;
            }

            $currentItemQuantity = $this->calculateCurrentCartQuantityForGivenSku(
                $itemsInCart,
                $itemTransfer->getSku(),
            );

            $productAvailabilityCriteriaTransfer = (new ProductAvailabilityCriteriaTransfer())
                ->fromArray($itemTransfer->toArray(), true);

            $isSellable = $this->availabilityFacade->isProductSellableForStore(
                $itemTransfer->getSku(),
                new Decimal($currentItemQuantity),
                $storeTransfer,
                $productAvailabilityCriteriaTransfer,
            );

            $productConcreteAvailabilityTransfer = $this->getProductConcreteAvailabilityBySkuForStore($itemTransfer->getSku(), $storeTransfer, $productAvailabilityCriteriaTransfer);

            $itemTransfer
                ->setAvailability($this->getProductConcreteAvailability($productConcreteAvailabilityTransfer)->toInt())
                ->setIsBuyable($isSellable)
                ->setIsNeverOutOfStock($this->isProductConcreteNeverOutOfStock($productConcreteAvailabilityTransfer));

            $itemsInCart->append($itemTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $items
     * @param string $sku
     *
     * @return int
     */
    protected function calculateCurrentCartQuantityForGivenSku(ArrayObject $items, $sku)
    {
        $quantity = 0;
        foreach ($items as $itemTransfer) {
            if ($itemTransfer->getSku() !== $sku) {
                continue;
            }
            $quantity += $itemTransfer->getQuantity();
        }

        return $quantity;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer|null $productConcreteAvailabilityTransfer
     *
     * @return \Spryker\DecimalObject\Decimal
     */
    protected function getProductConcreteAvailability(?ProductConcreteAvailabilityTransfer $productConcreteAvailabilityTransfer): Decimal
    {
        if ($productConcreteAvailabilityTransfer !== null) {
            return $productConcreteAvailabilityTransfer->getAvailability();
        }

        return new Decimal(0);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer|null $productConcreteAvailabilityTransfer
     *
     * @return bool
     */
    protected function isProductConcreteNeverOutOfStock(?ProductConcreteAvailabilityTransfer $productConcreteAvailabilityTransfer): bool
    {
        if ($productConcreteAvailabilityTransfer !== null) {
            return $productConcreteAvailabilityTransfer->getIsNeverOutOfStock() === true;
        }

        return false;
    }

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param \Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer $productAvailabilityCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer|null
     */
    protected function getProductConcreteAvailabilityBySkuForStore(
        string $sku,
        StoreTransfer $storeTransfer,
        ProductAvailabilityCriteriaTransfer $productAvailabilityCriteriaTransfer
    ): ?ProductConcreteAvailabilityTransfer {
        $productConcreteAvailabilityTransfer = $this->availabilityFacade
            ->findOrCreateProductConcreteAvailabilityBySkuForStore($sku, $storeTransfer, $productAvailabilityCriteriaTransfer);

        if ($productConcreteAvailabilityTransfer !== null) {
            return $productConcreteAvailabilityTransfer;
        }

        return null;
    }
}
