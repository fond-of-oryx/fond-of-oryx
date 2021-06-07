<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function toTransfer(array $data): CreditMemoTransfer;
}
