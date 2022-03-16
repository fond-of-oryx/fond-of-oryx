<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface OmsOrderMailExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer;
}
