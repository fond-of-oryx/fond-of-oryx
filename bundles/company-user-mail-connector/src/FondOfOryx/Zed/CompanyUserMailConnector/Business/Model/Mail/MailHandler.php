<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail;

use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailTransfer;

class MailHandler implements MailHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface
     */
    protected $mailFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface $mailFacade
     */
    public function __construct(CompanyUserMailConnectorToMailFacadeInterface $mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function sendMail(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        $customerTransfer = $companyUserTransfer->getCustomer();

        if ($customerTransfer->getIsNew() !== true) {
            return $companyUserTransfer;
        }

        $mailTransfer = new MailTransfer();
        $mailTransfer->setType(CustomerRegistrationMailTypePlugin::MAIL_TYPE);
        $mailTransfer->setCustomer($customerTransfer);
        $mailTransfer->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);

        return $companyUserTransfer;
    }
}
