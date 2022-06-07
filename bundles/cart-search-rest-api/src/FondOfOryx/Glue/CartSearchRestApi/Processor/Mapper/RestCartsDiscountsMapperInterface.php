<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsDiscountsTransfer;

interface RestCartsDiscountsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCartsDiscountsTransfer>
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsDiscountsTransfer
     */
    public function fromDiscount(DiscountTransfer $discountTransfer): RestCartsDiscountsTransfer;
}
