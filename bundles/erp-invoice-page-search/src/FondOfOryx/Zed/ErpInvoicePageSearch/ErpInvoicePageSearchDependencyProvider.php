<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 */
class ErpInvoicePageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const QUERY_ERP_INVOICE_PAGE_SEARCH = 'QUERY_ERP_INVOICE_PAGE_SEARCH';

    /**
     * @var string
     */
    public const QUERY_ERP_INVOICE = 'QUERY_ERP_INVOICE';

    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addEventBehaviorFacade($container);

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

        $container = $this->addErpInvoicePageSearchQuery($container);
        $container = $this->addErpInvoiceQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new ErpInvoicePageSearchToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = static function (Container $container) {
            return new ErpInvoicePageSearchToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpInvoicePageSearchQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_INVOICE_PAGE_SEARCH] = static function () {
            return FooErpInvoicePageSearchQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpInvoiceQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_INVOICE] = static function () {
            return FooErpInvoiceQuery::create();
        };

        return $container;
    }
}
