<?php

namespace FondOfOryx\Zed\ErpInvoiceApi;

use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeBridge;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeBridge;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryBuilderQueryContainerBridge;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpInvoiceApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ERP_INVOICE = 'FACADE_ERP_INVOICE';

    /**
     * @var string
     */
    public const FACADE_API = 'FACADE_API';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';

    /**
     * @var string
     */
    public const PROPEL_QUERY_ERP_INVOICE = 'PROPEL_QUERY_ERP_INVOICE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addErpInvoiceFacade($container);

        return $this->addApiFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpInvoiceFacade(Container $container): Container
    {
        $container[static::FACADE_ERP_INVOICE] = static function (Container $container) {
            return new ErpInvoiceApiToErpInvoiceFacadeBridge(
                $container->getLocator()->erpInvoice()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new ErpInvoiceApiToApiFacadeBridge(
                $container->getLocator()->api()->facade(),
            );
        };

        return $container;
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

        $this->addErpInvoicePropelQuery($container);
        $this->addApiFacade($container);

        return $this->addApiQueryBuilderQueryContainer($container);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpInvoicePropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_ERP_INVOICE] = static function () {
            return FooErpInvoiceQuery::create();
        };

        return $container;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = static function (Container $container) {
            return new ErpInvoiceApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }
}
