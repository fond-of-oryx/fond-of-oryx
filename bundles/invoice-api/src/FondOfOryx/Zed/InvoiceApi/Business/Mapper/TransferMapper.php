<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function toTransfer(array $data): InvoiceTransfer
    {
        return (new InvoiceTransfer())->fromArray($data, true);
    }
}
