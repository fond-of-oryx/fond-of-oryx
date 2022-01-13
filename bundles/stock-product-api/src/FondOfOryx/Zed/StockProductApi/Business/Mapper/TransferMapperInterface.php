<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Mapper;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    public function toTransfer(array $data);

    /**
     * @param array $stockEntityCollection
     *
     * @return array<\Generated\Shared\Transfer\StockProductTransfer>
     */
    public function toTransferCollection(array $stockEntityCollection);
}
