<?php

namespace FondOfOryx\Zed\MailProxy\Communication\Plugin\MailExtension;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailProxy\Communication\MailProxyCommunicationFactory getFactory()
 */
class ProxyMailProviderPlugin extends AbstractPlugin implements MailProviderPluginInterface
{
    /**
     * @var \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface
     */
    protected MailProviderPluginInterface $mailProviderPlugin;

    /**
     * @param \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface $mailProviderPlugin
     */
    public function __construct(MailProviderPluginInterface $mailProviderPlugin)
    {
        $this->mailProviderPlugin = $mailProviderPlugin;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function sendMail(MailTransfer $mailTransfer): void
    {
        foreach ($this->getFactory()->getMailExpanderPlugins() as $mailExpanderPlugin) {
            $mailTransfer = $mailExpanderPlugin->expand($mailTransfer);
        }

        $this->mailProviderPlugin->sendMail($mailTransfer);
    }
}
