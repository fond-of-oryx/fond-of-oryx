<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector;

use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade\CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeBridge;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyUsersBulkRestApiBusinessCentralConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY = 'QUERY_SPY_COMPANY';

    /**
     * @var string
     */
    public const FACADE_COMPANY_USERS_BULK_REST_API = 'FACADE_COMPANY_USERS_BULK_REST_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyUsersBulkRestApiFacade($container);

        return $this->addSpyCompanyQuery($container);
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
    protected function addCompanyUsersBulkRestApiFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USERS_BULK_REST_API] = static function (Container $container) {
            return new CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeBridge($container->getLocator()->companyUsersBulkRestApi()->facade());
        };

        return $container;
    }
}
