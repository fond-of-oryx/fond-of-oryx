<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail;

use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CompanyUserWasCreatedInformerMailTypePlugin;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailTransfer;

class InformationMailHandler implements InformationMailHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface
     */
    protected $mailFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig
     */
    protected $config;

    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig $config
     */
    public function __construct(CompanyUserMailConnectorToMailFacadeInterface $mailFacade, CompanyUserMailConnectorRepositoryInterface $repository, CompanyUserMailConnectorConfig $config)
    {
        $this->mailFacade = $mailFacade;
        $this->config = $config;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function sendInformationMail(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        $customerTransfer = $companyUserTransfer->getCustomer();

        if ($customerTransfer->getIsNew() !== true || $this->checkRoles($companyUserTransfer->getCompanyRoleCollection()) !== true) {
            return $companyUserTransfer;
        }

        $inform = $this->repository->getNotificationCustomerByFkCompanyAndRole($companyUserTransfer->getFkCompany(), $this->config->getRolesToNotify());

        foreach ($inform->getNotificationCustomers() as $notificationCustomer){
            $mailTransfer = new MailTransfer();
            $mailTransfer->setType(CompanyUserWasCreatedInformerMailTypePlugin::MAIL_TYPE);
            $mailTransfer->setCustomer($customerTransfer);
            $mailTransfer->setLocale($customerTransfer->getLocale());
            $mailTransfer->setNotifyCustomer($notificationCustomer);
            $this->mailFacade->handleMail($mailTransfer);
        }

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleCollectionTransfer $companyRoleCollectionTransfer
     * @return bool
     */
    protected function checkRoles(CompanyRoleCollectionTransfer $companyRoleCollectionTransfer): bool
    {
        $configRoles = $this->config->getRolesToInformAbout();
        foreach ($companyRoleCollectionTransfer->getRoles() as $role ){
            if (in_array($role->getName(), $configRoles)){
                return true;
            }
        }

        return false;
    }
}
