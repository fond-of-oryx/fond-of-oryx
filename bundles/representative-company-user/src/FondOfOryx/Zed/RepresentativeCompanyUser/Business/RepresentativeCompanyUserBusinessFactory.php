<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReader;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunner;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriter;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriterInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeBridge;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\RepresentativeCompanyUserDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface getEntityManager()
 */
class RepresentativeCompanyUserBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunner
     */
    public function createTaskRunner(): TaskRunner
    {
        return new TaskRunner(
            $this->getEntityManager(),
            $this->getTaskPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriterInterface
     */
    public function createRepresentativeCompanyUserWriter(): RepresentativeCompanyUserWriterInterface
    {
        return new RepresentativeCompanyUserWriter(
            $this->createRepresentativeCompanyUserReader(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface
     */
    public function createRepresentativeCompanyUserReader(): RepresentativeCompanyUserReaderInterface
    {
        return new RepresentativeCompanyUserReader(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createRepresentationManager(): RepresentationManagerInterface
    {
        return new RepresentationManager(
            $this->createRepresentativeCompanyUserWriter(),
            $this->createRepresentativeCompanyUserReader(),
            $this->getEventFacade(),
            $this->getUtilUuidGeneratorService()
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCompanyUserManager(): CompanyUserManagerInterface
    {
        return new CompanyUserManager(
            $this->createRepresentativeCompanyUserReader(),
            $this->getCompanyUserFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getUtilUuidGeneratorService(): RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::SERVICE_UTIL_UUID_GENERATOR);
    }

    /**
     * @return array<\FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface>
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getTaskPlugins(): array
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::PLUGINS_TASKS);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUserFacade(): RepresentativeCompanyUserToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getEventFacade(): RepresentativeCompanyUserToEventFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::FACADE_EVENT);
    }
}
