<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Mapper;

use Generated\Shared\Transfer\ErpOrderApiTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ErpOrderApiTransfer
     */
    public function toTransfer(array $data): ErpOrderApiTransfer;

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ErpOrderApiTransfer[]
     */
    public function toTransferCollection(array $data): array;
}
