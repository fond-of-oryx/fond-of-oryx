<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
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
