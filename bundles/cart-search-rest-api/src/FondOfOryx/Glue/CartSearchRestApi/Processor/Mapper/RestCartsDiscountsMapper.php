<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsDiscountsTransfer;

class RestCartsDiscountsMapper implements RestCartsDiscountsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCartsDiscountsTransfer>
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ArrayObject
    {
        $restCartsDiscountsTransfers = new ArrayObject();

        foreach ($quoteTransfer->getVoucherDiscounts() as $discountTransfer) {
            $restCartsDiscountsTransfers->append($this->fromDiscount($discountTransfer));
        }

        foreach ($quoteTransfer->getCartRuleDiscounts() as $discountTransfer) {
            $restCartsDiscountsTransfers->append($this->fromDiscount($discountTransfer));
        }

        return $restCartsDiscountsTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsDiscountsTransfer
     */
    public function fromDiscount(DiscountTransfer $discountTransfer): RestCartsDiscountsTransfer
    {
        return (new RestCartsDiscountsTransfer())
            ->fromArray($discountTransfer->toArray(), true);
    }
}
