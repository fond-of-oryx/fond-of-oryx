<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FooThirtyFiveUpOrderEntityTransfer;

    /**
     * @param array $data
     *
     * @return array<\Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer>
     */
    public function toTransferCollection(array $data): array;
}
