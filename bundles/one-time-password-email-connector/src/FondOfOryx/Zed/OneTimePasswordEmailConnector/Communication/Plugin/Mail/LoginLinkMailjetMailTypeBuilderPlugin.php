<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail;

use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorConfig getConfig()
 * @method \FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\OneTimePasswordEmailConnectorCommunicationFactory getFactory()()
 */
class LoginLinkMailjetMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_LOCALE = 'en_US';

    /**
     * @var string
     */
    public const CUSTOMER = 'customer';

    /**
     * @var string
     */
    public const FIRST_NAME = 'firstName';

    /**
     * @var string
     */
    public const LAST_NAME = 'lastName';

    /**
     * @var string
     */
    public const ONE_TIME_PASSWORD_LOGIN_LINK = 'oneTimePasswordLoginLink';

    /**
     * @uses OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin::MAIL_TYPE
     *
     * @var string
     */
    public const MAIL_TYPE = 'one time password login link mail';

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
            static::ONE_TIME_PASSWORD_LOGIN_LINK => $this->getOneTimePasswordLoginLink($mailTransfer->getOneTimePasswordLoginLink()),
            static::CUSTOMER => [
                static::FIRST_NAME => $mailTransfer->getCustomerOrFail()->getFirstName(),
                static::LAST_NAME => $mailTransfer->getCustomerOrFail()->getLastName(),
            ],
        ]);
    }

    /**
     * @param string|null $oneTimePasswordLoginLink
     *
     * @return string|null
     */
    protected function getOneTimePasswordLoginLink(?string $oneTimePasswordLoginLink): ?string
    {
        if ($oneTimePasswordLoginLink === null) {
            return null;
        }

        $searchParamOperator = (parse_url($oneTimePasswordLoginLink, PHP_URL_QUERY) ? '&' : '?');

        return sprintf('%s%semailType=welcomeBack', $oneTimePasswordLoginLink, $searchParamOperator);
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

        return $this->getConfig()->getOneTimePasswordLoginLinkMailTemplateIdByLocale($locale);
    }
}
