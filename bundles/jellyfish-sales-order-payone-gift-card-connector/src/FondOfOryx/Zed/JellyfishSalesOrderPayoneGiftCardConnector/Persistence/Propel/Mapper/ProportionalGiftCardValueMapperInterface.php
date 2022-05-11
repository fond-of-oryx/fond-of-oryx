<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue;

interface ProportionalGiftCardValueMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     * @param \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue|null $fooProportionalGiftCardValue
     *
     * @return \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue
     */
    public function mapTransferToEntity(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer,
        ?FooProportionalGiftCardValue $fooProportionalGiftCardValue = null
    ): FooProportionalGiftCardValue;

    /**
     * @param \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue $fooProportionalGiftCardValue
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function mapEntityToTransfer(
        FooProportionalGiftCardValue $fooProportionalGiftCardValue,
        ?ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer = null
    ): ProportionalGiftCardValueTransfer;
}
