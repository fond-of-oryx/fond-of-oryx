<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface OneTimePasswordEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendOneTimePasswordMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendLoginLinkMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void;
}
