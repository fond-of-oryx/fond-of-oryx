<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordEmailConnector implements OneTimePasswordEmailConnectorInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE_LOGIN_LINK = 'MAIL_TYPE_LOGIN_LINK';

    /**
     * @var string
     */
    public const MAIL_TYPE = 'MAIL_TYPE';

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge
     */
    protected $mailFacade;

    /**
     * @var array<string>
     */
    protected array $mailTypes;

    /**
     * @param \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge $mailFacade
     * @param array<string> $mailTypes
     */
    public function __construct(OneTimePasswordEmailConnectorToMailBridge $mailFacade, array $mailTypes)
    {
        $this->mailFacade = $mailFacade;
        $this->mailTypes = $mailTypes;
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendOneTimePasswordMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $customerTransfer = $oneTimePasswordResponseTransfer
            ->requireOneTimePasswordPlain()
            ->requireCustomerTransfer()
            ->getCustomerTransfer();

        $mailTransfer = (new MailTransfer())
            ->setType($this->mailTypes[static::MAIL_TYPE])
            ->setCustomer($customerTransfer)
            ->setOneTimePasswordPlain($oneTimePasswordResponseTransfer->getOneTimePasswordPlain())
            ->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendLoginLinkMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $customerTransfer = $oneTimePasswordResponseTransfer
            ->requireLoginLink()
            ->requireCustomerTransfer()
            ->getCustomerTransfer();

        $mailTransfer = (new MailTransfer())
            ->setType($this->mailTypes[self::MAIL_TYPE_LOGIN_LINK])
            ->setCustomer($customerTransfer)
            ->setOneTimePasswordLoginLink($oneTimePasswordResponseTransfer->getLoginLink())
            ->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }
}
