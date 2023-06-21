<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade;

use Generated\Shared\Transfer\MessageTransfer;

interface InactiveQuoteItemFilterToMessengerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $message
     *
     * @return void
     */
    public function addInfoMessage(MessageTransfer $message): void;
}
