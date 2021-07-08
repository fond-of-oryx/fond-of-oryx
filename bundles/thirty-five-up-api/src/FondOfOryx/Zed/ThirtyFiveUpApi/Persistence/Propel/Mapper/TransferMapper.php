<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FooThirtyFiveUpOrderEntityTransfer
    {
        $thirtyFiveUpOrderTransfer = new FooThirtyFiveUpOrderEntityTransfer();

        return $thirtyFiveUpOrderTransfer->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer[]
     */
    public function toTransferCollection(array $data): array
    {
        $transferList = [];
        foreach ($data as $itemData) {
            $transferList[] = $this->toTransfer($itemData);
        }

        return $transferList;
    }
}
