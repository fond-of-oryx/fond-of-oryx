<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsAttributesTransfer;

class RestCartsAttributesMapper implements RestCartsAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapperInterface
     */
    protected $restCartsDiscountsMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapperInterface
     */
    protected $restCartsTotalsMapper;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapperInterface $restCartsDiscountsMapper
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapperInterface $restCartsTotalsMapper
     */
    public function __construct(
        RestCartsDiscountsMapperInterface $restCartsDiscountsMapper,
        RestCartsTotalsMapperInterface $restCartsTotalsMapper
    ) {
        $this->restCartsDiscountsMapper = $restCartsDiscountsMapper;
        $this->restCartsTotalsMapper = $restCartsTotalsMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsAttributesTransfer
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): RestCartsAttributesTransfer
    {
        $currencyTransfer = $quoteTransfer->getCurrency();
        $storeTransfer = $quoteTransfer->getStore();

        return (new RestCartsAttributesTransfer())
            ->fromArray($quoteTransfer->toArray(), true)
            ->setDiscounts($this->restCartsDiscountsMapper->fromQuote($quoteTransfer))
            ->setTotals($this->restCartsTotalsMapper->fromQuote($quoteTransfer))
            ->setStore($storeTransfer !== null ? $storeTransfer->getName() : null)
            ->setCurrency($currencyTransfer !== null ? $currencyTransfer->getCode() : null);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCartsAttributesTransfer>
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): ArrayObject
    {
        $restCartsAttributesTransfers = new ArrayObject();

        foreach ($quoteListTransfer->getQuotes() as $quoteTransfer) {
            $restCartsAttributesTransfers->append($this->fromQuote($quoteTransfer));
        }

        return $restCartsAttributesTransfers;
    }
}
