<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\Mail\Business;

use FondOfOryx\Zed\Mail\Business\Model\Provider\SwiftMailer;
use FondOfOryx\Zed\Mail\Dependency\Mailer\MailToMailerInterface;
use FondOfOryx\Zed\Mail\MailDependencyProvider;
use Spryker\Zed\Mail\Business\MailBusinessFactory as SprykerMailBusinessFactory;

/**
 * @method \FondOfOryx\Zed\Mail\MailConfig getConfig()
 */
class MailBusinessFactory extends SprykerMailBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\Mail\Business\Model\Provider\SwiftMailer
     */
    public function createMailer(): SwiftMailer
    {
        return new SwiftMailer(
            $this->createRenderer(),
            $this->getMailer()
        );
    }

    /**
     * @return \FondOfOryx\Zed\Mail\Dependency\Mailer\MailToMailerInterface
     */
    protected function getMailer(): MailToMailerInterface
    {
        return $this->getProvidedDependency(MailDependencyProvider::MAILER);
    }
}
