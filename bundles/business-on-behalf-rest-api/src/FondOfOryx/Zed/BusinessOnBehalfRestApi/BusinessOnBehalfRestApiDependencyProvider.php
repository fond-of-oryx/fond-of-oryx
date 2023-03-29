<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi;

use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeBridge;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BusinessOnBehalfRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_BUSINESS_ON_BEHALF = 'FACADE_BUSINESS_ON_BEHALF';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_USER = 'PROPEL_QUERY_COMPANY_USER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addBusinessOnBehalfFacade($container);

        return $this->addCompanyUserFacade($container);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addCompanyUserQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBusinessOnBehalfFacade(Container $container): Container
    {
        $container[static::FACADE_BUSINESS_ON_BEHALF] = static fn (
            Container $container
        ) => new BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge(
            $container->getLocator()->businessOnBehalf()->facade(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = static fn (
            Container $container
        ) => new BusinessOnBehalfRestApiToCompanyUserFacadeBridge(
            $container->getLocator()->companyUser()->facade(),
        );

        return $container;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_USER] = static fn () => SpyCompanyUserQuery::create();

        return $container;
    }
}
