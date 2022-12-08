<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Generated\Shared\Transfer\MailjetClientRequestTransfer;
use Generated\Shared\Transfer\MailTransfer;

interface MailjetClientRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetClientRequestTransfer
     */
    public function mailTransferToRequest(MailTransfer $mailTransfer): MailjetClientRequestTransfer;
}
