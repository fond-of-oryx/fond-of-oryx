<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

interface CustomerTransferToMailTransferMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function map(CustomerTransfer $customerTransfer): MailTransfer;
}
