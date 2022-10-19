<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordLoginLinkSender implements OneTimePasswordLoginLinkSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface
     */
    protected $oneTimePasswordLinkGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
     */
    protected $oneTimePasswordEmailConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface $oneTimePasswordLinkGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade
     */
    public function __construct(
        OneTimePasswordLinkGeneratorInterface $oneTimePasswordLinkGenerator,
        OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface $oneTimePasswordEmailConnectorFacade
    ) {
        $this->oneTimePasswordLinkGenerator = $oneTimePasswordLinkGenerator;
        $this->oneTimePasswordEmailConnectorFacade = $oneTimePasswordEmailConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLink(
        CustomerTransfer $customerTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer {
        $customerTransfer->requireEmail();

        $oneTimePasswordResponseTransfer = $this->oneTimePasswordLinkGenerator->generateLoginLink(
            $customerTransfer,
            $attributesTransfer,
        );

        if ($oneTimePasswordResponseTransfer->getIsSuccess()) {
            $this->oneTimePasswordEmailConnectorFacade->sendLoginLinkMail($oneTimePasswordResponseTransfer);
        }

        return $oneTimePasswordResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer {
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
            $orderTransfer,
            $attributesTransfer,
        );

        if ($oneTimePasswordResponseTransfer->getIsSuccess()) {
            $this->oneTimePasswordEmailConnectorFacade->sendLoginLinkMail($oneTimePasswordResponseTransfer);
        }

        return $oneTimePasswordResponseTransfer;
    }
}
