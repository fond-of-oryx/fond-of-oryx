<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\Mail;

use FondOfOryx\Zed\Mail\MailConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface;
use Spryker\Zed\Mail\Dependency\Plugin\MailTypePluginInterface;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacade getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Communication\AvailabilityAlertCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 */
class AvailabilityAlertMailTypePlugin extends AbstractPlugin implements MailTypePluginInterface
{
    public const MAIL_TYPE = 'availability alert mail';

    /**
     * @var \FondOfOryx\Zed\Mail\MailConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\Mail\MailConfig $config
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
    protected function setRecipient(MailBuilderInterface $mailBuilder)
    {
        $availabilityAlertSubscriptionTransfer = $mailBuilder->getMailTransfer()
            ->requireAvailabilityAlertSubscription()
            ->getAvailabilityAlertSubscription();

        $mailBuilder->addRecipient(
            $availabilityAlertSubscriptionTransfer->getSubscriber()->getEmail(),
            ''
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setSubject(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setSubject('availability_alert.mail.subject');

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setHtmlTemplate(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setHtmlTemplate('AvailabilityAlert/Mail/availability_alert.html.twig');

        return $this;
    }

    /**
     * @param \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface $mailBuilder
     *
     * @return $this
     */
    protected function setTextTemplate(MailBuilderInterface $mailBuilder)
    {
        $mailBuilder->setTextTemplate('AvailabilityAlert/Mail/availability_alert.text.twig');

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
