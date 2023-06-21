<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManager;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionChecker;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataEnrichmentPluginExecutioner;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataEnrichmentPluginExecutionerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CompanyUsersBulkRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface
     */
    public function createBulkManager(): BulkManagerInterface
    {
        return new BulkManager(
            $this->createPermissionChecker(),
            $this->getEventFacade(),
            $this->createBulkDataEnrichmentPluginExecutioner()
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
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataEnrichmentPluginExecutionerInterface
     */
    public function createBulkDataEnrichmentPluginExecutioner(): BulkDataEnrichmentPluginExecutionerInterface
    {
        return new BulkDataEnrichmentPluginExecutioner(
            $this->getPreEnrichmentPlugins(),
            $this->getPostEnrichmentPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getEventFacade(): CompanyUsersBulkRestApiToEventFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::EVENT_FACADE,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface[]
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getPreEnrichmentPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PLUGINS_PRE_ENRICHMENT,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPostEnrichmentPluginInterface[]
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getPostEnrichmentPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PLUGINS_POST_ENRICHMENT,
        );
    }
}
