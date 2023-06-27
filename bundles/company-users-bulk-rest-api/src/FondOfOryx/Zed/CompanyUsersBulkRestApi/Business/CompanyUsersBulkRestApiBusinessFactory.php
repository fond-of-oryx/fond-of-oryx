<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManager;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionChecker;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutioner;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutionerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CompanyUsersBulkRestApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface
     */
    public function createBulkManager(): BulkManagerInterface
    {
        return new BulkManager(
            $this->createPermissionChecker(),
            $this->getEventFacade(),
            $this->getCompanyUserFacade(),
            $this->createBulkDataPluginExecutioner(),
            $this->getRepository(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface
     */
    public function createPermissionChecker(): PermissionCheckerInterface
    {
        return new PermissionChecker($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutionerInterface
     */
    public function createBulkDataPluginExecutioner(): BulkDataPluginExecutionerInterface
    {
        return new BulkDataPluginExecutioner(
            $this->getDataExpanderPlugins(),
            $this->getPreHandlingPlugins(),
            $this->getPostHandlingPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface
     */
    public function getEventFacade(): CompanyUsersBulkRestApiToEventFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::FACADE_EVENT,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface
     */
    public function getCompanyUserFacade(): CompanyUsersBulkRestApiToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::FACADE_COMPANY_USER,
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface>
     */
    public function getDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PLUGINS_DATA_EXPANDER,
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreHandlingPluginInterface>
     */
    public function getPreHandlingPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PLUGINS_PRE_HANDLING,
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostHandlingPluginInterface>
     */
    public function getPostHandlingPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PLUGINS_POST_HANDLING,
        );
    }
}
