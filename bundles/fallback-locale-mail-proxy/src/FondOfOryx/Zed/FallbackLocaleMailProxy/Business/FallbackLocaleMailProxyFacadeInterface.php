<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business;

use Generated\Shared\Transfer\MailTransfer;

interface FallbackLocaleMailProxyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandMail(MailTransfer $mailTransfer): MailTransfer;
}
