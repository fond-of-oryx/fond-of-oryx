<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailProvider;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorFacadeInterface getFacade()
 */
class MailjetMailProviderPlugin extends AbstractPlugin implements MailProviderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function sendMail(MailTransfer $mailTransfer): void
    {
        $this->getFacade()->sendMail($mailTransfer);
    }
}
