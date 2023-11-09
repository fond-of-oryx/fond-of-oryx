<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail;

use FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CompanyUserWasCreatedInformerMailTypePlugin;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailTransfer;

class CompanyUserCreationNotificationMailHandler implements CompanyUserCreationNotificationMailHandlerInterface
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
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig
     */
    protected CompanyUserMailConnectorConfig $config;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface
     */
    protected CompanyUserMailConnectorRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface $localeReader
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig $config
     */
    public function __construct(
        LocaleReaderInterface $localeReader,
        CompanyUserMailConnectorToMailFacadeInterface $mailFacade,
        CompanyUserMailConnectorRepositoryInterface $repository,
        CompanyUserMailConnectorConfig $config
    ) {
        $this->localeReader = $localeReader;
        $this->mailFacade = $mailFacade;
        $this->config = $config;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function sendCustomerNotificationMails(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        $customerTransfer = $companyUserTransfer->getCustomer();

        if ($customerTransfer->getIsNew() !== true || $this->checkRoles($companyUserTransfer->getCompanyRoleCollection()) !== true) {
            return $companyUserTransfer;
        }

        $inform = $this->repository->getNotificationCustomerByFkCompanyAndRole(
            $companyUserTransfer->getFkCompany(),
            $this->config->getRolesToNotify(),
        );

        foreach ($inform->getNotificationCustomers() as $notificationCustomer) {
            if ($customerTransfer->getEmail() === $notificationCustomer->getEmail()) {
                continue;
            }

            $mailTransfer = (new MailTransfer())
                ->setType(CompanyUserWasCreatedInformerMailTypePlugin::MAIL_TYPE)
                ->setCustomer($customerTransfer)
                ->setLocale($this->localeReader->getByNotificationCustomer($notificationCustomer))
                ->setNotifyCustomer($notificationCustomer);

            $this->mailFacade->handleMail($mailTransfer);
        }

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleCollectionTransfer $companyRoleCollectionTransfer
     *
     * @return bool
     */
    protected function checkRoles(CompanyRoleCollectionTransfer $companyRoleCollectionTransfer): bool
    {
        $configRoles = $this->config->getRolesToInformAbout();
        foreach ($companyRoleCollectionTransfer->getRoles() as $role) {
            if (in_array($role->getName(), $configRoles)) {
                return true;
            }
        }

        return false;
    }
}
