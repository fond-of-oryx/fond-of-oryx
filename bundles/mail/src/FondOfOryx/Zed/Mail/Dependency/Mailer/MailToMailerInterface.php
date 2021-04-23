<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\Mail\Dependency\Mailer;

use Spryker\Zed\Mail\Dependency\Mailer\MailToMailerInterface as SprykerMailToMailerInterface;

interface MailToMailerInterface extends SprykerMailToMailerInterface
{
    /**
     * @param string $email
     * @param string|null $name
     *
     * @return void
     */
    public function addBcc(string $email, ?string $name = null): void;
}
