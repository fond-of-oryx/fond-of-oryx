<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business;

use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig getConfig()
 */
class CompanyUserMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface
     */
    public function createMailHandler(): MailHandlerInterface
    {
        return new MailHandler($this->getMailFacade());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface
     */
    public function createCompanyUserCreationNotificationMailHandler(): CompanyUserCreationNotificationMailHandlerInterface
    {
        return new CompanyUserCreationNotificationMailHandler(
            $this->getMailFacade(),
            $this->getRepository(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface
     */
    protected function getMailFacade(): CompanyUserMailConnectorToMailFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserMailConnectorDependencyProvider::FACADE_MAIL);
    }
}
