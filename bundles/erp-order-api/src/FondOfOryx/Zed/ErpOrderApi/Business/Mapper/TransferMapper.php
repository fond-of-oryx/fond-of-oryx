<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Mapper;

use Generated\Shared\Transfer\ErpOrderApiTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ErpOrderApiTransfer
     */
    public function toTransfer(array $data): ErpOrderApiTransfer
    {
        return (new ErpOrderApiTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ErpOrderApiTransfer[]
     */
    public function toTransferCollection(array $data): array
    {
        $transferCollection = [];

        foreach ($data as $itemData) {
            $transferCollection[] = $this->toTransfer($itemData);
        }

        return $transferCollection;
    }
}
