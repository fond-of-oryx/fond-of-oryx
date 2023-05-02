<?php

namespace FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin;

use Generated\Shared\Transfer\MailTransfer;

interface MailExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer): MailTransfer;
}
