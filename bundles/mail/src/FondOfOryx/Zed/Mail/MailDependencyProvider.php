<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\Mail;

use FondOfOryx\Zed\Mail\Dependency\Mailer\MailToMailerBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Mail\MailDependencyProvider as SprykerMailDependencyProvider;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * @method \FondOfOryx\Zed\Mail\MailConfig getConfig()
 */
class MailDependencyProvider extends SprykerMailDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailer(Container $container): Container
    {
        $container[static::MAILER] = function () {
            $transport = new Swift_SmtpTransport(
                $this->getConfig()->getSmtpHost(),
                $this->getConfig()->getSmtpPort()
            );

            $user = $this->getConfig()->getUser();
            if ($user !== null) {
                $transport->setUsername($user);
            }

            $password = $this->getConfig()->getPassword();
            if ($password !== null) {
                $transport->setPassword($password);
            }

            $encryption = $this->getConfig()->getEncryption();
            if ($encryption !== null) {
                $transport->setEncryption($encryption);
            }

            $authMode = $this->getConfig()->getAuthMode();
            if ($authMode !== null) {
                $transport->setAuthMode($authMode);
            }

            return new MailToMailerBridge(
                new Swift_Message(),
                new Swift_Mailer($transport)
            );
        };

        return $container;
    }
}
