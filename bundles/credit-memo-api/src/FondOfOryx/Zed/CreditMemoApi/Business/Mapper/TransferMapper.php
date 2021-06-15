<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function toTransfer(array $data): CreditMemoTransfer
    {
        return (new CreditMemoTransfer())->fromArray($data, true);
    }
}
