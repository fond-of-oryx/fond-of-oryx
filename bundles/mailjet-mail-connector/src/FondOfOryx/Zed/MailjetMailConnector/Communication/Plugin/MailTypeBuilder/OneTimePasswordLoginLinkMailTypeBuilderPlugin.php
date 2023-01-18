<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
 * @method \FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory getFactory()
 */
class OneTimePasswordLoginLinkMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    public const CUSTOMER = 'customer';

    /**
     * @var string
     */
    public const ONE_TIME_PASSWORD_LOGIN_LINK = 'oneTimePasswordLoginLink';

    /**
     * @var string
     */
    public const MAIL_TYPE = 'one time password login link mail';

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
            ->setSubject('mail.customer.one-time-password.login-link.subject')
            ->setTemplateId($this->getTemplateId($mailTransfer));

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
            static::ONE_TIME_PASSWORD_LOGIN_LINK => $mailTransfer->getOneTimePasswordLoginLink(),
            static::CUSTOMER => $this->getMappedCustomer($mailTransfer->getCustomer()),
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return array
     */
    protected function getMappedCustomer(CustomerTransfer $customerTransfer): array
    {
        return $this->getFactory()
            ->createMailjetTemplateVariablesCustomerMapper()
            ->map($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return int
     */
    protected function getTemplateId(MailTransfer $mailTransfer): int
    {
        $locale = $mailTransfer->getLocale()->getLocaleName();

        return $this->getConfig()->getOneTimePasswordLoginLinkMailTemplateIdByLocale($locale);
    }
}
