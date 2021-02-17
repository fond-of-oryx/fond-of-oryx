<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\Mail;

use FondOfOryx\Shared\Mail\MailConstants;
use Spryker\Zed\Mail\MailConfig as SprykerMailConfig;

class MailConfig extends SprykerMailConfig
{
    protected const DEFAULT_SENDER_NAME = 'mail.sender.name';
    protected const DEFAULT_SENDER_EMAIL = 'mail.sender.email';

    /**
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->get(MailConstants::MAIL_SENDER_NAME, static::DEFAULT_SENDER_NAME);
    }

    /**
     * @return string
     */
    public function getSenderEmail(): string
    {
        return $this->get(MailConstants::MAIL_SENDER_EMAIL, static::DEFAULT_SENDER_EMAIL);
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        if (!$this->getConfig()->hasValue(MailConstants::MAILER_SMTP_USER)) {
            return null;
        }

        return $this->get(MailConstants::MAILER_SMTP_USER);
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        if (!$this->getConfig()->hasValue(MailConstants::MAILER_SMTP_PASSWORD)) {
            return null;
        }

        return $this->get(MailConstants::MAILER_SMTP_PASSWORD);
    }

    /**
     * @return string|null
     */
    public function getEncryption(): ?string
    {
        if (!$this->getConfig()->hasValue(MailConstants::MAILER_SMTP_ENCRYPTION)) {
            return null;
        }

        return $this->get(MailConstants::MAILER_SMTP_ENCRYPTION);
    }

    /**
     * @return string|null
     */
    public function getAuthMode(): ?string
    {
        if (!$this->getConfig()->hasValue(MailConstants::MAILER_SMTP_AUTH_MODE)) {
            return null;
        }

        return $this->get(MailConstants::MAILER_SMTP_AUTH_MODE);
    }
}
