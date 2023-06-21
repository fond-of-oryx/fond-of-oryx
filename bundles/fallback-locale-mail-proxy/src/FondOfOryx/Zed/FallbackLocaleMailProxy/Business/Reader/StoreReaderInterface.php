<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface StoreReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getByMail(MailTransfer $mailTransfer): StoreTransfer;
}
