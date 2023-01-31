<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail;

use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface getFacade()
 */
class OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE = 'one time password login link mail';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_HTML = 'OneTimePasswordEmailConnector/Mail/one_time_password_email_connector_login_link.html.twig';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_TEXT = 'OneTimePasswordEmailConnector/Mail/one_time_password_email_connector_login_link.text.twig';

    /**
     * @var string
     */
    protected const GLOSSARY_KEY_MAIL_SUBJECT = 'mail.customer.one-time-password.login-link.subject';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function build(MailTransfer $mailTransfer): MailTransfer
    {
        return $mailTransfer
            ->setSubject(static::GLOSSARY_KEY_MAIL_SUBJECT)
            ->addTemplate(
                (new MailTemplateTransfer())
                    ->setName(static::MAIL_TEMPLATE_HTML)
                    ->setIsHtml(true),
            )
            ->addTemplate(
                (new MailTemplateTransfer())
                    ->setName(static::MAIL_TEMPLATE_TEXT)
                    ->setIsHtml(false),
            )
            ->addRecipient(
                (new MailRecipientTransfer())
                    ->setName(
                        sprintf(
                            '%s %s',
                            $mailTransfer->getCustomerOrFail()->getFirstName(),
                            $mailTransfer->getCustomerOrFail()->getLastName(),
                        ),
                    )
                    ->setEmail($mailTransfer->getCustomerOrFail()->getEmail()),
            );
    }
}
