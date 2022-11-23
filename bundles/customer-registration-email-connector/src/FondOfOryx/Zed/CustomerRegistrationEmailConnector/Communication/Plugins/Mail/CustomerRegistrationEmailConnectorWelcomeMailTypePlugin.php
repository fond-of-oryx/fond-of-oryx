<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\Mail;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface;
use Spryker\Zed\Mail\Dependency\Plugin\MailTypePluginInterface;
use Spryker\Zed\Mail\MailConfig;

class CustomerRegistrationEmailConnectorWelcomeMailTypePlugin extends AbstractPlugin implements MailTypePluginInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE = 'customer registration welcome mail';

    /**
     * @var \Spryker\Zed\Mail\MailConfig
     */
    protected $config;

    /**
     * @param \Spryker\Zed\Mail\MailConfig $config
     */
    public function __construct(MailConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return void
     */
    public function build(MailBuilderInterface $mailBuilder): void
    {
        $this->setSubject($mailBuilder)
            ->setHtmlTemplate($mailBuilder)
            ->setTextTemplate($mailBuilder)
            ->setSender($mailBuilder)
            ->setRecipient($mailBuilder);
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setSubject(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setSubject('mail.customer.customer-registration.welcome-mail.subject');

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setHtmlTemplate(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setHtmlTemplate('CustomerRegistrationEmailConnector/Mail/customer_registration_email_connector_welcome_mail.html.twig');

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setTextTemplate(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setTextTemplate('CustomerRegistrationEmailConnector/Mail/customer_registration_email_connector_welcome_mail.text.twig');

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setRecipient(MailBuilderInterface $mailBuilder)
    {
        $customerTransfer = $mailBuilder->getMailTransfer()->getCustomerOrFail();

        $mailBuilder->addRecipient(
            $customerTransfer->getEmail(),
            sprintf(
                '%s %s',
                $customerTransfer->getFirstName(),
                $customerTransfer->getLastName(),
            ),
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setSender(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setSender($this->config->getSenderEmail(), $this->config->getSenderName());

        return $this;
    }
}
