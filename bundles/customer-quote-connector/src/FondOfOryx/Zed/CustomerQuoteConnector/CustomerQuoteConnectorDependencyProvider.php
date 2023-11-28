<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector;

use FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeInterface;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CustomerQuoteConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_CUSTOMER = 'PROPEL_QUERY_CUSTOMER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        return $this->addCustomerFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CUSTOMER] = static fn (
            Container $container
        ): CustomerQuoteConnectorToCustomerFacadeInterface => new CustomerQuoteConnectorToCustomerFacadeBridge(
            $container->getLocator()->customer()->facade(),
        );

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

        return $this->addCustomerQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CUSTOMER] = static fn (
            Container $container
        ): SpyCustomerQuery => SpyCustomerQuery::create();

        return $container;
    }
}
