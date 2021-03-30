<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi;

use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiRestApiToCompanyAddressApiFacadeBridge;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const COMPANY_UNIT_ADDRESS_API_FACADE = 'COMPANY_UNIT_ADDRESS_API_FACADE';
    public const PROPEL_QUERY_COMPANY_UNIT_ADDRESS = 'PROPEL_QUERY_COMPANY_UNIT_ADDRESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->getCompanyUnitAddressApiFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyUnitAddressPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCompanyUnitAddressApiFacade(Container $container): Container
    {
        $container->set(static::COMPANY_UNIT_ADDRESS_API_FACADE, static function (Container $container) {
            return new ReturnLabelsRestApiRestApiToCompanyAddressApiFacadeBridge(
                $container->getLocator()->companyUnitAddressApi()->facade()
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_UNIT_ADDRESS] = function () {
            return SpyCompanyUnitAddressQuery::create();
        };

        return $container;
    }
}
