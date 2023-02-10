<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @deprecated Use {@link \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail\CustomerRegistrationWelcomeMailjetMailTypeBuilder} instead
 */
class CustomerRegistrationWelcomeMailTypeBuilder extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return 'customer registration welcome mail';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function build(MailTransfer $mailTransfer): MailTransfer
    {
        return $mailTransfer;
    }
}
