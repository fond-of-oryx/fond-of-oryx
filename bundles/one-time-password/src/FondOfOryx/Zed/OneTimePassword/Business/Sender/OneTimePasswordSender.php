<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordSender implements OneTimePasswordSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
     */
    protected $oneTimePasswordEmailConnector;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface $oneTimePasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade
     */
    public function __construct(
        OneTimePasswordGeneratorInterface $oneTimePasswordGenerator,
        OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade
    ) {
        $this->oneTimePasswordGenerator = $oneTimePasswordGenerator;
        $this->oneTimePasswordEmailConnector = $oneTimePasswordEmailConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
        $customerTransfer->requireEmail();

        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if ($oneTimePasswordResponseTransfer->getIsSuccess()) {
            $this->oneTimePasswordEmailConnector->sendOneTimePasswordMail($oneTimePasswordResponseTransfer);
        }

        return $oneTimePasswordResponseTransfer;
    }
}
