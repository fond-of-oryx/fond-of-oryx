<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Sender;

use Generated\Shared\Transfer\CustomerTransfer;

interface WelcomeMailSenderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer): void;
}
