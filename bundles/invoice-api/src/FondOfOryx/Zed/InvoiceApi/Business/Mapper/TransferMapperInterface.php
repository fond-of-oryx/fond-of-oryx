<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function toTransfer(array $data): InvoiceTransfer;
}
