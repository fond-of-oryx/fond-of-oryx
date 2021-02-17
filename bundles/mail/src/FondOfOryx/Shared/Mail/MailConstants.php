<?php

declare(strict_types = 1);

namespace FondOfOryx\Shared\Mail;

use Spryker\Shared\Mail\MailConstants as SprykerMailConstants;

interface MailConstants extends SprykerMailConstants
{
    public const MAIL_SENDER_NAME = 'MAIL_SENDER_NAME';
    public const MAIL_SENDER_EMAIL = 'MAIL_SENDER_EMAIL';

    public const MAILER_SMTP_USER = 'MAILER_SMTP_USER';
    public const MAILER_SMTP_PASSWORD = 'MAILER_SMTP_PASSWORD';
    public const MAILER_SMTP_ENCRYPTION = 'MAILER_SMTP_ENCRYPTION';
    public const MAILER_SMTP_AUTH_MODE = 'MAILER_SMTP_AUTH_MODE';

    public const MAILER_SMTP_AUTH_MODE_CRAM_MD5 = 'cram-md5';
    public const MAILER_SMTP_AUTH_MODE_PLAIN = 'plain';
    public const MAILER_SMTP_AUTH_MODE_LOGIN = 'login';

    public const MAILER_SMTP_ENCRYPTION_TLS = 'tls';
    public const MAILER_SMTP_ENCRYPTION_SSL = 'ssl';
}
