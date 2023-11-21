<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReader;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunner;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunnerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\RepresentativeCompanyUserDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface getEntityManager()
 */
class RepresentativeCompanyUserBusinessFactory extends AbstractBusinessFactory
{
    use TransactionTrait;

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunner
     */
    public function createTaskRunner(): TaskRunnerInterface
    {
        return new TaskRunner(
            $this->getEntityManager(),
            $this->getTaskPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface
     */
    public function createRepresentativeCompanyUserReader(): RepresentativeCompanyUserReaderInterface
    {
        return new RepresentativeCompanyUserReader(
            $this->getRepository(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface
     */
    public function createRepresentationManager(): RepresentationManagerInterface
    {
        return new RepresentationManager(
            $this->getEntityManager(),
            $this->createRepresentativeCompanyUserReader(),
            $this->getEventFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface
     */
    public function createCompanyUserManager(): CompanyUserManagerInterface
    {
        return new CompanyUserManager(
            $this->createRepresentativeCompanyUserReader(),
            $this->getCompanyUserFacade(),
            $this->getTransactionHandler(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface>
     */
    protected function getTaskPlugins(): array
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::PLUGINS_TASKS);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): RepresentativeCompanyUserToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface
     */
    protected function getEventFacade(): RepresentativeCompanyUserToEventFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::FACADE_EVENT);
    }
}
