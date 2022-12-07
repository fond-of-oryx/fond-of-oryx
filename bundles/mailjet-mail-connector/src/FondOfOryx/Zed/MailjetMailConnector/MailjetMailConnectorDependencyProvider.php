<?php

namespace FondOfOryx\Zed\MailjetMailConnector;

use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use Mailjet\Client as MailjetClient;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
 */
class MailjetMailConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const MAILER_PROVIDER_MAILJET = 'MailjetMailConnector:MAILER_PROVIDER_MAILJET';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addMailer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailer(Container $container): Container
    {
        $self = $this;

        $container->set(static::MAILER_PROVIDER_MAILJET, static function () use ($self) {
            return $self->getMailer();
        });

        return $container;
    }

    /**
     * @return \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface
     */
    protected function getMailer(): MailProviderPluginInterface
    {
        return new MailjetMailer(
            new MailjetClient(
                $this->getConfig()->getMailjetKey(),
                $this->getConfig()->getMailjetSecret(),
                $this->getConfig()->isMailjetApiCallEnabled(),
                [
                    MailjetClient::TIMEOUT => $this->getConfig()->getMailjetTimeout(),
                    MailjetClient::CONNECT_TIMEOUT => $this->getConfig()->getMailjetConnectionTimeout(),
                ],
            ),
        );
    }
}
