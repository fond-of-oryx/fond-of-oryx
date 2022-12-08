<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorBusinessFactory getFactory()
 */
class MailjetMailConnectorFacade extends AbstractFacade implements MailjetMailConnectorFacadeInterface
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
        $this->getFactory()
            ->createMailjetMailer()
            ->sendMail($mailTransfer);
    }
}
