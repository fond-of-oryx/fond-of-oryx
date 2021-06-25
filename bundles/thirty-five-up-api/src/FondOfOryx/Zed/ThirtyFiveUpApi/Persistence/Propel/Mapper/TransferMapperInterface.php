<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FosThirtyFiveUpOrderEntityTransfer;

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer[]
     */
    public function toTransferCollection(array $data): array;
}
