<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorBusinessFactory getFactory()
 */
class OneTimePasswordEmailConnectorFacade extends AbstractFacade implements OneTimePasswordEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendOneTimePasswordMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $this->getFactory()
            ->createOneTimePasswordEmailConnector()
            ->sendOneTimePasswordMail($oneTimePasswordResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendLoginLinkMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $this->getFactory()
            ->createOneTimePasswordEmailConnector()
            ->sendLoginLinkMail($oneTimePasswordResponseTransfer);
    }
}
