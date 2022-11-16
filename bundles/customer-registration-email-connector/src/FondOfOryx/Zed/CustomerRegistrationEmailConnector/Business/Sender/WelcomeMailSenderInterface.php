<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender;

use Generated\Shared\Transfer\CustomerTransfer;

interface WelcomeMailSenderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param string $link
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer, string $link): void;
}
