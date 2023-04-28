<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander;

use Generated\Shared\Transfer\MailTransfer;

interface MailExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer): MailTransfer;
}
