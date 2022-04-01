<?php

namespace FondOfOryx\Zed\GiftCardApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\GiftCardTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCard;

interface GiftCardMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCard $spyGiftCard
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer
     */
    public function fromEntity(SpyGiftCard $spyGiftCard): GiftCardTransfer;

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer
     */
    public function fromData(array $data): GiftCardTransfer;

    /**
     * @param array $data
     *
     * @return array
     */
    public function toTransferCollection(array $data);
}
