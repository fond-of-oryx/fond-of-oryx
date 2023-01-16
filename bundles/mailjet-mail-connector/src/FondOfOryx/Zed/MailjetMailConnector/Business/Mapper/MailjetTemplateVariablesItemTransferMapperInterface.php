<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Generated\Shared\Transfer\ItemTransfer;

interface MailjetTemplateVariablesItemTransferMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array<string, mixed>
     */
    public function itemTransferToArray(ItemTransfer $itemTransfer): array;
}
