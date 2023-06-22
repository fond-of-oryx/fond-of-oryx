<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\CompanyResolverPreEnrichmentPlugin;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\CustomerResolverPreEnrichmentPlugin;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeBridge;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyUsersBulkRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY_USER = 'QUERY_SPY_COMPANY_USER';

    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY = 'QUERY_SPY_COMPANY';

    /**
     * @var string
     */
    public const QUERY_SPY_CUSTOMER = 'QUERY_SPY_CUSTOMER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PERMISSION = 'PROPEL_QUERY_PERMISSION';

    /**
     * @var string
     */
    public const FACADE_EVENT = 'FACADE_EVENT';

    /**
     * @var string
     */
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    /**
     * @var string
     */
    public const PLUGINS_PRE_ENRICHMENT = 'PLUGINS_PRE_ENRICHMENT';

    /**
     * @var string
     */
    public const PLUGINS_POST_ENRICHMENT = 'PLUGINS_POST_ENRICHMENT';

    /**
     * @var string
     */
    public const PLUGINS_PRE_HANDLING = 'PLUGINS_PRE_HANDLING';

    /**
     * @var string
     */
    public const PLUGINS_POST_HANDLING = 'PLUGINS_POST_HANDLING';

    /**
     * @var string
     */
    public const PLUGINS_PRE_ASSIGN = 'PLUGINS_PRE_ASSIGN';

    /**
     * @var string
     */
    public const PLUGINS_POST_ASSIGN = 'PLUGINS_POST_ASSIGN';

    /**
     * @var string
     */
    public const PLUGINS_PRE_UNASSIGN = 'PLUGINS_PRE_UNASSIGN';

    /**
     * @var string
     */
    public const PLUGINS_POST_UNASSIGN = 'PLUGINS_POST_UNASSIGN';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addSpyCompanyQuery($container);
        $container = $this->addSpyCompanyUserQuery($container);
        $container = $this->addSpyCustomerQuery($container);

        return $this->addPermissionQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCompanyUserFacade($container);
        $container = $this->addPostEnrichmentPlugins($container);
        $container = $this->addPreEnrichmentPlugins($container);
        $container = $this->addPostHandlingPlugins($container);
        $container = $this->addPreHandlingPlugins($container);
        $container = $this->addPostAssignPlugins($container);
        $container = $this->addPreAssignPlugins($container);
        $container = $this->addPostUnassignPlugins($container);
        $container = $this->addPreUnassignPlugins($container);

        return $this->addEventFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCustomerQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_CUSTOMER] = static function () {
            return new SpyCustomerQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCompanyUserQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY_USER] = static function () {
            return new SpyCompanyUserQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCompanyQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY] = static function () {
            return new SpyCompanyQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PERMISSION] = static function () {
            return SpyPermissionQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT] = static function (Container $container) {
            return new CompanyUsersBulkRestApiToEventFacadeBridge($container->getLocator()->event()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = static function (Container $container) {
            return new CompanyUsersBulkRestApiToCompanyUserFacadeBridge($container->getLocator()->companyUser()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPreEnrichmentPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_PRE_ENRICHMENT] = static function (Container $container) use ($self) {
            return $self->getPreEnrichmentPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface>
     */
    protected function getPreEnrichmentPlugins(): array
    {
        return [
            new CompanyResolverPreEnrichmentPlugin(),
            new CustomerResolverPreEnrichmentPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPostEnrichmentPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_POST_ENRICHMENT] = static function (Container $container) use ($self) {
            return $self->getPostEnrichmentPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPostEnrichmentPluginInterface>
     */
    protected function getPostEnrichmentPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPreHandlingPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_PRE_HANDLING] = static function (Container $container) use ($self) {
            return $self->getPreHandlingPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreHandlingPluginInterface>
     */
    protected function getPreHandlingPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPostHandlingPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_POST_HANDLING] = static function (Container $container) use ($self) {
            return $self->getPostHandlingPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostHandlingPluginInterface>
     */
    protected function getPostHandlingPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPreAssignPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_PRE_ASSIGN] = static function (Container $container) use ($self) {
            return $self->getPreAssignPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreAssignPluginInterface>
     */
    protected function getPreAssignPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPostAssignPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_POST_ASSIGN] = static function (Container $container) use ($self) {
            return $self->getPostAssignPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostAssignPluginInterface>
     */
    protected function getPostAssignPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPreUnassignPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_PRE_UNASSIGN] = static function (Container $container) use ($self) {
            return $self->getPreUnassignPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPreUnassignPluginInterface>
     */
    protected function getPreUnassignPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPostUnassignPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_POST_UNASSIGN] = static function (Container $container) use ($self) {
            return $self->getPostUnassignPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkPostUnassignPluginInterface>
     */
    protected function getPostUnassignPlugins(): array
    {
        return [];
    }
}
