<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FosThirtyFiveUpOrderEntityTransfer
    {
        $thirtyFiveUpOrderTransfer = new FosThirtyFiveUpOrderEntityTransfer();

        return $thirtyFiveUpOrderTransfer->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer[]
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
