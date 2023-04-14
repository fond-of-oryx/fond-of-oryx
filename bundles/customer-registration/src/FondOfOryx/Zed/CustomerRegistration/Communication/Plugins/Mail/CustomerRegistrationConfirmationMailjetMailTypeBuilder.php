<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail;

use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig getConfig()
 * @method \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory getFactory()
 */
class CustomerRegistrationConfirmationMailjetMailTypeBuilder extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_LOCALE = 'en_US';

    /**
     * @var string
     */
    public const MAIL_TYPE = 'customer registration confirmation mail';

    /**
     * @var string
     */
    protected const GLOSSARY_KEY_MAIL_SUBJECT = 'mail.customer.customer-registration.confirmation.subject';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
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
        $mailjetTemplateTransfer = (new MailjetTemplateTransfer())
            ->setSubject(static::GLOSSARY_KEY_MAIL_SUBJECT)
            ->setTemplateId($this->getTemplateId());

        return $mailTransfer->setMailjetTemplate(
            $this->setVariables($mailTransfer, $mailjetTemplateTransfer),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\MailjetTemplateTransfer $mailjetTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetTemplateTransfer
     */
    protected function setVariables(
        MailTransfer $mailTransfer,
        MailjetTemplateTransfer $mailjetTemplateTransfer
    ): MailjetTemplateTransfer {
        return $mailjetTemplateTransfer->setVariables([
            'emailVerificationLink' => sprintf(
                '%s&email=%s',
                $mailTransfer->getCustomer()->getConfirmationLink(),
                $mailTransfer->getCustomer()->getEmail(),
            ),
        ]);
    }

    /**
     * @return int
     */
    protected function getTemplateId(): int
    {
        $locale = static::DEFAULT_LOCALE;

        $localeTransfer = $this->getFactory()
            ->getLocaleFacade()
            ->getCurrentLocale();

        if ($localeTransfer->getLocaleName() !== null) {
            $locale = $localeTransfer->getLocaleName();
        }

        return $this->getConfig()->getCustomerRegistrationConfirmationMailTemplateIdByLocale($locale);
    }
}
