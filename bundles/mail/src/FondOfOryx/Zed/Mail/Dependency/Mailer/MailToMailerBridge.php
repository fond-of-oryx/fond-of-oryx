<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\Mail\Dependency\Mailer;

use Spryker\Zed\Mail\Dependency\Mailer\MailToMailerBridge as SprykerMailToMailer;

class MailToMailerBridge extends SprykerMailToMailer implements MailToMailerInterface
{
    /**
     * @param string $email
     * @param string|null $name
     *
     * @return void
     */
    public function addBcc(string $email, ?string $name = null): void
    {
        $this->message->addBcc($email, $name);
    }
}
