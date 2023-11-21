<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail;

use FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailTransfer;

class MailHandler implements MailHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface
     */
    protected LocaleReaderInterface $localeReader;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface
     */
    protected CompanyUserMailConnectorToMailFacadeInterface $mailFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface $localeReader
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface $mailFacade
     */
    public function __construct(
        LocaleReaderInterface $localeReader,
        CompanyUserMailConnectorToMailFacadeInterface $mailFacade
    ) {
        $this->localeReader = $localeReader;
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
        $mailTransfer->setLocale($this->localeReader->getByCustomer($customerTransfer));

        $this->mailFacade->handleMail($mailTransfer);

        return $companyUserTransfer;
    }
}
