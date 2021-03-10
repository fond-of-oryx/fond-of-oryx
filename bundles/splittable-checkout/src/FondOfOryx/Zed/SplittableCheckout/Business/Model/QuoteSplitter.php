<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Model;

use ArrayObject;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PersistentCartChangeTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use phpDocumentor\GraphViz\Exception;

class QuoteSplitter implements QuoteSplitterInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     */
    protected $splittableCheckoutToPersistentCartFacade;

    /**
     * QuoteSplitter constructor.
     *
     * @param \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig $config
     */
    public function __construct(
        SplittableCheckoutToPersistentCartFacadeInterface $splittableCheckoutToPersistentCartFacade,
        SplittableCheckoutConfig $config
    ) {
        $this->config = $config;
        $this->splittableCheckoutToPersistentCartFacade = $splittableCheckoutToPersistentCartFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function split(QuoteTransfer $quoteTransfer): QuoteCollectionTransfer
    {
        $quoteCollectionTransfer = new QuoteCollectionTransfer();
        if ($this->config->getQuoteSplitQuoteItemAttribute() === '') {
            return $quoteCollectionTransfer->addQuote($quoteTransfer);
        }

        $quoteItemsGroups = $this->getQuoteItemsGroupedBySplitAttribute($quoteTransfer);

        if (count($quoteItemsGroups) === 0) {
            return $quoteCollectionTransfer->addQuote($quoteTransfer);
        }

        return  $this->createQuoteCollection($quoteTransfer, $quoteItemsGroups);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer[][]
     */
    protected function getQuoteItemsGroupedBySplitAttribute(QuoteTransfer $quoteTransfer): array
    {
        $quoteItemsGroups = [];
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $properties = $itemTransfer->toArray();
            if (isset($properties[$this->config->getQuoteSplitQuoteItemAttribute()]) === false) {
                continue;
            }

            $quoteItemsGroups[$properties[$this->config->getQuoteSplitQuoteItemAttribute()]][] = $itemTransfer;
        }

        return $quoteItemsGroups;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array $quoteItemsGroups
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     *
     * @throws \phpDocumentor\GraphViz\Exception
     */
    protected function createQuoteCollection(
        QuoteTransfer $quoteTransfer,
        array $quoteItemsGroups
    ): QuoteCollectionTransfer {

        $quoteCollectionTransfer = new QuoteCollectionTransfer();
        foreach ($quoteItemsGroups as $itemsGroup) {
            $quoteCollectionTransfer->addQuote(
                $this->createQuoteTransfer($quoteTransfer, $itemsGroup)
            );
        }

        return $quoteCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ItemTransfer[] $items
     * @return \Generated\Shared\Transfer\QuoteTransfer
     *
     * @throws \phpDocumentor\GraphViz\Exception
     */
    protected function createQuoteTransfer(
        QuoteTransfer $quoteTransfer,
        array $items
    ): QuoteTransfer {

        $splitQuoteTransfer = (new QuoteTransfer())->fromArray($quoteTransfer->toArray())
            ->setIdQuote(null)
            ->setUuid(null)
            ->setItems($this->mapItemsArrayToItemsArrayObject($items))
            ->setIsDefault(false);

        $quoteResponseTransfer = $this->persistQuoteTransfer($splitQuoteTransfer);

        if ($quoteResponseTransfer->getIsSuccessful() === false) {
            throw new Exception('The Quote could not be saved');
        }

        return $splitQuoteTransfer;
    }

    /**
     * @param  \Generated\Shared\Transfer\ItemTransfer[] $items
     * @return  \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[]
     */
    protected function mapItemsArrayToItemsArrayObject(array $items): ArrayObject
    {
        $itemsArrayObject = new ArrayObject();

        foreach ($items as $item)
        {
            $itemsArrayObject->append($item);
        }

        return $itemsArrayObject;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected function persistQuoteTransfer (QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->splittableCheckoutToPersistentCartFacade->createQuote($quoteTransfer);
    }
}
