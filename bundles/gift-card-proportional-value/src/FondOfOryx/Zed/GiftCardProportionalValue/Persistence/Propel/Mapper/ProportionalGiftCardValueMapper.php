<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue;

class ProportionalGiftCardValueMapper implements ProportionalGiftCardValueMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     * @param \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue|null $fooProportionalGiftCardValue
     *
     * @return \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue
     */
    public function mapTransferToEntity(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer,
        ?FooProportionalGiftCardValue $fooProportionalGiftCardValue = null
    ): FooProportionalGiftCardValue {
        if ($fooProportionalGiftCardValue === null) {
            $fooProportionalGiftCardValue = new FooProportionalGiftCardValue();
        }

        $fooProportionalGiftCardValue->fromArray(
            $proportionalGiftCardValueTransfer->modifiedToArray(false),
        );

        return $fooProportionalGiftCardValue;
    }

    /**
     * @param \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue $fooProportionalGiftCardValue
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function mapEntityToTransfer(
        FooProportionalGiftCardValue $fooProportionalGiftCardValue,
        ?ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer = null
    ): ProportionalGiftCardValueTransfer {
        if ($proportionalGiftCardValueTransfer === null) {
            $proportionalGiftCardValueTransfer = new ProportionalGiftCardValueTransfer();
        }

        $proportionalGiftCardValueTransfer->fromArray($fooProportionalGiftCardValue->toArray(), true);

        return $proportionalGiftCardValueTransfer;
    }
}
