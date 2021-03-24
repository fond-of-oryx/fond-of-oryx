<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge implements OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface
     */
    protected $oneTimePasswordEmailConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade
     */
    public function __construct(OneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade)
    {
        $this->oneTimePasswordEmailConnectorFacade = $oneTimePasswordEmailConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendOneTimePasswordMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $this->oneTimePasswordEmailConnectorFacade->sendOneTimePasswordMail($oneTimePasswordResponseTransfer);
    }
}
