<?php

namespace FondOfOryx\Zed\GiftCardApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\GiftCardTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCard;

class GiftCardMapper implements GiftCardMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCard $spyGiftCard
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer
     */
    public function fromEntity(SpyGiftCard $spyGiftCard): GiftCardTransfer
    {
        return (new GiftCardTransfer())->fromArray($spyGiftCard->toArray(), true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer
     */
    public function fromData(array $data): GiftCardTransfer
    {
        return (new GiftCardTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function toTransferCollection(array $data)
    {
        $transferList = [];
        foreach ($data as $itemData) {
            $transferList[] = $this->fromData($itemData);
        }

        return $transferList;
    }
}
